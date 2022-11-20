<?php

namespace App\Http\Controllers\Tenant\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Cliente;
use App\Models\Tenant\Cotizacion;
use App\Models\Tenant\Detalle_Cotizacion;
use App\Models\Tenant\Empresa;
use App\Models\Tenant\Estatus_Cotizacion;
use App\Models\Tenant\Producto_Servicio;
use App\Models\Tenant\Tipo_Producto_Servicio;
use App\Models\Tenant\Unidad_De_Medida;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Swift_Mailer;
use Swift_SmtpTransport;

class CotizacionesController extends Controller
{
  protected $redirectTo = '/home';
  protected $tenantName = null;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('cotizaciones');
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
  }

  /**
   * Función index()
   * retorna la vista system.cotizaciones.index
   * donde se enlistan las cotizaciones realizadas por el usuario (interno) o por el empleado
   */
  public function index()
  {
    $cotizaciones = "";

    if (Auth::guard('cliente')->check()) {
      $cliente_id = Auth::guard('cliente')->user()->cliente_id;
      $cotizaciones = Cotizacion::where("cliente_id", "=", $cliente_id)->paginate(10);
    }

    if (Auth::check()) {
      $user_id = Auth::user()->user_id;
      $cotizaciones = Cotizacion::where("usuario_id", "=", $user_id)->paginate(10);
    }

    return view('system.cotizaciones.index', [
      'cotizaciones' => $cotizaciones,
    ]);
  }

  /**
   * Función showCotizacionForm()
   * obtiene la información requerida por la vista system.cotizaciones.cotizacion
   * donde se muestra el formulario para la creación de una cotización
   * por parte de un usuario (interno) o por un cliente
   */
  public function showCotizacionForm()
  {
    $estatus = Estatus_Cotizacion::all();
    $tipos = Tipo_Producto_Servicio::all();
    $unidades = Unidad_De_Medida::all();

    $cotizaciones = Cotizacion::orderBy('cotizacion_id', 'DESC')->get();
    $count = count($cotizaciones);

    if ($count === 0) {
      $cotSiguiente = 1;
    } else {
      $cotSiguiente = $cotizaciones[0]->cotizacion_id + 1;
    }

    $folio = "COT-$cotSiguiente";

    $usuario = "interno";
    $cliente = "";

    if (Auth::guard('cliente')->check()) {
      $usuario = "cliente";
      $cliente = Auth::guard('cliente')->user();
    }

    if (Auth::check()) {
      $usuario = "interno";
    }

    return view('system.cotizaciones.cotizacion', [
      "estatus" => $estatus,
      "tipos" => $tipos,
      "unidades" => $unidades,
      "usuario" => $usuario,
      "cliente" => $cliente,
      "folio" => $folio
    ]);
  }

  /**
   * Función buscarCliente()
   * a partir del término ingresado en el formulario de cotización
   * obtiene la información del cliente que se busca
   */
  public function buscarCliente(Request $request)
  {
    $term = $request->get('term');
    $buscarCliente = Cliente::where('email', 'like', "%$term%")->get();
    return response()->json($buscarCliente);
  }

  /**
   * Función seleccionarCliente()
   * obtiene la información del cliente
   * que se seleccionó en la búsqueda dentro del formulario de cotización
   */
  public function seleccionarCliente(Request $request)
  {
    $cliente = Cliente::where('email', $request->cliente)->first();
    return response()->json($cliente);
  }

  /**
   * Función buscarServicio()
   * a partir del término ingresado en el formulario de cotización
   * obtiene la información del producto y/o servicio que se busca
   */
  public function buscarServicio(Request $request)
  {
    $term = $request->get('term');
    $buscarServicio = Producto_Servicio::where('nombre', 'like', "%$term%")->get();
    return response()->json($buscarServicio);
  }

  /**
   * Función seleccionarServicio()
   * obtiene la información del producto y/o servicio
   * que se seleccionó en la búsqueda dentro del formulario de cotización
   */
  public function seleccionarServicio(Request $request)
  {
    $servicio = Producto_Servicio::where('nombre', $request->servicio)->first();
    return response()->json($servicio);
  }

  /**
   * Función registrarCliente()
   * obtiene los datos introducidos en el modal de registro de un nuevo cliente
   * válida que los datos sean correctos
   * Si no son válidos, regresa al modal los mensajes de error
   * Si los datos son válidos, hace el registro del nuevo cliente en la tabla correspondiente
   */
  public function registrarCliente(Request $request)
  {
    $rules = [
      'nombre' => 'required|max:45',
      'apep' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|numeric|digits_between:10,10',
      'correo' => 'required|email|max:100|unique:tenant.clientes,email|unique:tenant.users,email',
      'contraseña' => 'required|min:8',
    ];

    $customMessages = [
      'nombre.required' => 'El nombre es obligatorio.',
      'nombre.max' => 'El nombre no debe contener más de 45 caracteres.',
      'apep.required' => 'El apellido paterno es obligatorio.',
      'apep.max' => 'El apellido paterno no debe contener más de 45 caracteres.',
      'apm.required' => 'El apellido materno es obligatorio.',
      'apm.max' => 'El apellido materno no debe contener más de 45 caracteres.',
      'direccion.required' => 'La dirección es obligatoria.',
      'direccion.max' => 'La dirección no debe contener más de 255 caracteres.',
      'telefono.required' => 'El teléfono es obligatorio.',
      'telefono.numeric' => 'El teléfono solo acepta valores numéricos.',
      'telefono.digits_between' => 'El teléfono debe ser de 10 dígitos.',
      'correo.required' => 'El correo es obligatorio.',
      'correo.email' => 'El formato del correo es incorrecto.',
      'correo.max' => 'El correo no debe contener más de 100 caracteres.',
      'correo.unique' => 'El correo ingresado ya está registrado.',
      'contraseña.required' => 'La contraseña es obligatoria.',
      'contraseña.min' => 'La contraseña no puede ser menor a 8 dígitos.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return response()->json([
        'type' => 'validate',
        'errors' => $validator->errors()
      ]);
    } else {
      $contraseñaEncriptada = Hash::make($request->get('contraseña'));
      $cliente = [
        'nombre' => $request->get('nombre'),
        'apellido_p' => $request->get('apep'),
        'apellido_m' => $request->get('apm'),
        'direccion' => $request->get('direccion'),
        'telefono' => $request->get('telefono'),
        'email' => $request->get('correo'),
        'password' => $contraseñaEncriptada,
        'rol_id' => 3,
      ];

      Cliente::create($cliente);
      return response()->json([
        'type' => 'validate',
        'errors' => false
      ]);
    }
  }

  /**
   * Función registrarServicio()
   * obtiene los datos introducidos en el modal de registro de un producto y/o servicio
   * válida que los datos sean correctos
   * Si no son válidos, regresa al modal los mensajes de error
   * Si los datos son válidos, hace el registro del nuevo producto y/o servicio
   * en la tabla correspondiente
   */
  public function registrarServicio(Request $request)
  {
    $rules = [
      'nombreServicio' => 'required|min:1|max:255',
      'descripcionServicio' => 'required|min:1',
      'codigoServicio' => 'required|min:1|max:45|unique:tenant.productos_servicios,codigo',
      'precioServicio' => 'required',
      'imagenServicio' => 'image|mimes:gif,jpeg,png,svg',
      'tipoServicio' => 'required',
      'unidadServicio' => 'required',
    ];

    $customMessages = [
      'nombreServicio.required' => 'El nombre es obligatorio.',
      'nombreServicio.min' => 'El nombre debe contener al menos un carácter.',
      'nombreServicio.max' => 'El nombre no debe contener más de 100 caracteres.',
      'descripcionServicio.required' => 'La descripción es obligatoria.',
      'descripcionServicio.min' => 'La descripción debe contener al menos un carácter.',
      'codigoServicio.required' => 'El código es obligatorio.',
      'codigoServicio.min' => 'El código debe contener al menos un carácter.',
      'codigoServicio.max' => 'El código no debe contener más de 45 caracteres.',
      'codigoServicio.unique' => 'El código ya fue registrado.',
      'precioServicio.required' => 'El precio es obligatorio.',
      'imagenServicio.image' => 'El archivo seleccionado no es una imagen.',
      'imagenServicio.mimes' => 'El formato de la imagen no es válido.',
      'imagenServicio.mimetypes' => 'El formato de la imagen no es válido.',
      'tipoServicio.required' => 'Se debe seleccionar un tipo.',
      'unidadServicio.required' => 'Se debe seleccionar una unidad.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {

      return response()->json([
        'type' => 'validate',
        'errors' => $validator->errors()
      ]);
    } else {
      if ($_FILES["imagenServicio"]['name'] !== "") {
        $nombre_imagen = $_FILES["imagenServicio"]['name'];
        $temporal = $_FILES["imagenServicio"]['tmp_name'];
        $img_destination = 'images/productos_servicios/';
        $img2 = time() . '-' . $nombre_imagen; // Se concatena el nombre de la imagen
        move_uploaded_file($temporal, $img_destination . $img2);
      } else {
        $img2 = 'sinImagen.svg';
      }

      $producto_servicio = [
        'nombre' => $request->get('nombreServicio'),
        'descripcion' => nl2br($request->get('descripcionServicio')),
        'codigo' => $request->get('codigoServicio'),
        'imagen' => $img2,
        'precio_bruto' => $request->get('precioServicio'),
        'tipo_id' => $request->get('tipoServicio'),
        'unidad_medida_id' => $request->get('unidadServicio'),
      ];

      Producto_Servicio::create($producto_servicio);

      return response()->json([
        'type' => 'validate',
        'errors' => false
      ]);
    }
  }

  /**
   * Función createCotizacion()
   * obtiene los datos introducidos en el formulario de crear cotización
   * válida que los datos sean correctos
   * Si no son válidos, regresa al formulario los mensajes de error
   * Si los datos son válidos, hace la cotización
   * e invoca a la función generarPDFCotizacion().
   */
  public function createCotizacion(Request $request)
  {

    $rules = [
      'nombreCliente' => 'required',
      'correoCliente' => 'required',
      'folio_cotizacion' => 'required',
      'descripcion' => 'required|min:1',
      'fecha_creacion' => 'required',
      'vigencia' => 'required',
      'estatus_cotizacion_id' => 'required',
      'servicio_uuid' => 'required',
      'descuento_general' => 'required',
      'numero_servicios' => 'required',
    ];

    $customMessages = [
      'nombreCliente.required' => 'El nombre del cliente es obligatorio.',
      'correoCliente.required' => 'El correo del cliente es obligatorio.',
      'folio_cotizacion.required' => 'El folio de la cotización es obligatorio.',
      'descripcion.required' => 'La descripción de la cotización es obligatoria.',
      'descripcion.min' => 'La descripción debe contener al menos 1 carácter.',
      'fecha_creacion.required' => 'La fecha de creación es obligatoria.',
      'vigencia.required' => 'La vigencia de la cotización es obligatoria.',
      'estatus_cotizacion_id.required' => 'El estatus de la cotización es obligatorio.',
      'servicio_uuid.required' => 'No se ha seleccionado nada para cotizar.',
      'descuento_general.required' => 'El descuento general es obligatorio.',
      'numero_servicios.required' => 'Se debe especificar la cantidad a cotizar.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect("/cotizacion")
        ->withInput($request->only('cliente_id', 'nombreCliente', 'correoCliente', 'descripcion', 'fecha_creacion', 'vigencia', 'estatus_cotizacion_id', 'descuento_general'))
        ->withErrors($validator);
    } else {

      return DB::transaction(function () use ($request) {

        if (Auth::guard('cliente')->check()) {
          $cotizacion = Cotizacion::create($request->all() + ['usuario_id' => 1]);
        }

        if (Auth::check()) {
          $cotizacion = Cotizacion::create($request->all() + ['usuario_id' => Auth::user()->user_id]);
        }

        foreach ($request->servicio_id as $index => $servicio_id) {
          $cotizacion->cotizaciones()->create([
            'cantidad' => $request->numero_servicios[$index] ?? 0,
            'precio_inicial' => $request->precio_inicial[$index],
            'precio_bruto' => $request->precio_bruto[$index],
            'iva' => $request->precio_iva[$index],
            'subtotal' => $request->subtotal[$index],
            'descuento_general' => $request->descuento_general,
            'descuento' => $request->descuento_aplicado[$index],
            'cotizacion_id' => $cotizacion->cotizacion_id,
            'producto_servicio_id' => $servicio_id,
          ]);
        }

        $this->generarPDFCotizacion($request, $cotizacion->cotizacion_id);

        return redirect()
          ->route('tenant.cotizaciones')
          ->with('crear', 'ok');
      });
    }
  }

  /**
   * Función generarPDFCotizacion()
   * obtiene los productos y/o servicios que pertenecen a la cotización que se realizó
   * genera el PDF y válida si el tenantName se encuentra entre las validaciones añadidas
   * para poder utilizar su configuración de email y contraseña para el envío correcto
   * de la cotización por el email configurado invocando a la función tenantEmailConfiguration
   * para dicha configuración
   */
  public function generarPDFCotizacion($request, $cotizacion_id)
  {
    $empresa = Empresa::all()->first();
    $fqdn = $empresa->fqdn;
    $cotizacion = Cotizacion::find($cotizacion_id);
    $unidades = Unidad_De_Medida::all();

    $servicios = Detalle_Cotizacion::select('detalle_cotizaciones.detalle_cotizacion_id', 'detalle_cotizaciones.cantidad', 'detalle_cotizaciones.descuento', 'detalle_cotizaciones.descuento_general', 'detalle_cotizaciones.precio_inicial', 'detalle_cotizaciones.precio_bruto', 'detalle_cotizaciones.iva', 'detalle_cotizaciones.subtotal', 'productos_servicios.nombre', 'productos_servicios.descripcion', 'productos_servicios.codigo', 'productos_servicios.unidad_medida_id')
      ->join('productos_servicios', 'detalle_cotizaciones.producto_servicio_id', '=', 'productos_servicios.producto_servicio_id')
      ->where("detalle_cotizaciones.cotizacion_id", "=", $cotizacion_id)
      ->get();

    if (count($servicios) > 0) {
      $subtotal = 0;
      $iva = 0;
      $total = 0;

      foreach($servicios as $servicio){
        $subtotal += ($servicio->precio_inicial - (($servicio->precio_inicial * $servicio->descuento)/100)) * $servicio->cantidad;
      }
      $iva = round(($subtotal * 0.16), 2);
      $total = round(($subtotal + $iva), 2);
      
      $pdf = Pdf::loadView('pdf.cotizacion', compact("request", "servicios", "empresa", "cotizacion", "unidades", "subtotal", "iva", "total"));

      /**
       * Al hacer la validación del tenant...
       * el nombre con el que se compara debe ser exactamente igual (Mayúsculas y minúsculas)
       */

      if ($this->tenantName === 'joele') {

        $this->tenantEmailConfiguration($request, $pdf, $servicios, "joeldome17@gmail.com", "ecfzmowdugttsxaq", $fqdn);
      } else {

        Mail::send('email.cotizacion', compact("servicios", "fqdn"), function ($mail) use ($pdf, $request) {
          $mail->from("devjoel17@gmail.com", '');
          $mail->to($request->correoCliente);
          $mail->subject("Cotización: $request->folio_cotizacion");
          $mail->attachData($pdf->output(), 'cotizacion.pdf');
        });
      }

      return $pdf->download('archivo.pdf'); // Descargar
      // return $pdf->stream('archivo.pdf'); // Ver en una nueva página
    }
  }

  /**
   * Función tenantEmailConfiguration()
   * recibe como argumento el correo y contraseña del email
   * desde donde se desean enviar las cotizaciones de cada tenant (empresa)
   * con estos datos aplica la nueva configuración para el correcto envío del email.
   */
  public function tenantEmailConfiguration($request, $pdf, $servicios, $email, $password, $fqdn)
  {
    // Copia del mailer actual
    $backup = Mail::getSwiftMailer();

    // Definiendo el gmail mailer
    $transport = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
    $transport->setUsername($email);
    $transport->setPassword($password);

    $gmail = new Swift_Mailer($transport);

    // Estableciendo el nuevo mailer
    Mail::setSwiftMailer($gmail);

    Mail::send('email.cotizacion', compact("servicios", "fqdn"), function ($mail) use ($pdf, $request, $email) {
      $mail->from($email, '');
      $mail->to($request->correoCliente);
      $mail->subject("Cotización: $request->folio_cotizacion");
      $mail->attachData($pdf->output(), 'cotizacion.pdf');
    });

    // Restaurando el mailer original
    Mail::setSwiftMailer($backup);
  }

  /**
   * Función showCotizacionEditForm()
   * obtiene los productos y/o servicios que pertenecen a la cotización que se desea editar
   * junto a los datos que solicita la vista de system.cotizaciones.edit
   */
  public function showCotizacionEditForm($cotizacion_id)
  {

    $cotizacion = Cotizacion::find($cotizacion_id);
    $estatus = Estatus_Cotizacion::all();

    $usuario = "interno";

    if (Auth::guard('cliente')->check()) {
      $usuario = "cliente";
    }

    if (Auth::check()) {
      $usuario = "interno";
    }

    $servicios = Detalle_Cotizacion::select('detalle_cotizaciones.detalle_cotizacion_id', 'detalle_cotizaciones.cantidad', 'detalle_cotizaciones.descuento', 'detalle_cotizaciones.descuento_general', 'detalle_cotizaciones.precio_inicial', 'detalle_cotizaciones.precio_bruto', 'detalle_cotizaciones.iva', 'detalle_cotizaciones.subtotal', 'productos_servicios.nombre', 'productos_servicios.descripcion')
      ->join('productos_servicios', 'detalle_cotizaciones.producto_servicio_id', '=', 'productos_servicios.producto_servicio_id')
      ->where("detalle_cotizaciones.cotizacion_id", "=", $cotizacion_id)
      ->get();

    return view('system.cotizaciones.edit', [
      'cotizacion' => $cotizacion,
      'estatus' => $estatus,
      'servicios' => $servicios,
      'usuario' => $usuario
    ]);
  }

  /**
   * Función editCotizacion()
   * obtiene los datos introducidos en el formulario de edición de cotización
   * válida que los datos sean correctos
   * Si no son válidos, regresa al formulario los mensajes de error
   * Si los datos son válidos, hace la actualización de la cotización
   * e invoca a la función generarPDFCotizacion().
   */
  public function editCotizacion(Request $request, $cotizacion_id)
  {

    $rules = [
      'folio_cotizacion' => 'required',
      'descripcion' => 'required|min:1',
      'estatus_cotizacion_id' => 'required',
      'descuento_general' => 'required',
    ];

    $customMessages = [
      'folio_cotizacion.required' => 'El folio de la cotización es obligatorio.',
      'descripcion.required' => 'La descripción de la cotización es obligatoria.',
      'descripcion.min' => 'La descripción debe contener al menos 1 carácter.',
      'estatus_cotizacion_id.required' => 'El estatus de la cotización es obligatorio.',
      'descuento_general.required' => 'El descuento general es obligatorio.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect("/cotizacion/$cotizacion_id/editar")
        ->withInput($request->only('folio_cotizacion', 'descripcion', 'estatus_cotizacion_id', 'descuento_general'))
        ->withErrors($validator);
    } else {
      foreach ($request->servicio_id as $index => $servicio_id) {
        if ($request->precio_inicial[$index] == null) {
          return back()
            ->withInput($request->only('folio_cotizacion', 'descripcion', 'estatus_cotizacion_id', 'descuento_general'))
            ->withErrors(['precio_inicial' => 'El precio es obligatorio.']);
        }

        if ($request->descuento[$index] == null) {
          return back()
            ->withInput($request->only('folio_cotizacion', 'descripcion', 'estatus_cotizacion_id', 'descuento_general'))
            ->withErrors(['descuento' => 'El descuento es obligatorio.']);
        }

        if ($request->cantidad[$index] == null) {
          return back()
            ->withInput($request->only('folio_cotizacion', 'descripcion', 'estatus_cotizacion_id', 'descuento_general'))
            ->withErrors(['cantidad' => 'La cantidad es obligatoria.']);
        }
      }

      $cotizacion = Cotizacion::find($cotizacion_id);

      $cotizacion->descripcion = $request->descripcion;
      $cotizacion->estatus_cotizacion_id = $request->estatus_cotizacion_id;
      $cotizacion->update();

      foreach ($request->servicio_id as $index => $servicio_id) {
        $detalle_cotizacion = Detalle_Cotizacion::find($servicio_id);

        $detalle_cotizacion->precio_inicial = $request->precio_inicial[$index] ?? 0;
        $detalle_cotizacion->cantidad = $request->cantidad[$index] ?? 1;
        $detalle_cotizacion->descuento = $request->descuento[$index] ?? 0;
        $detalle_cotizacion->descuento_general = $request->descuento_general;
        $detalle_cotizacion->precio_bruto = $request->precio_bruto[$index];
        $detalle_cotizacion->iva = $request->precio_iva[$index];
        $detalle_cotizacion->subtotal = $request->subtotal[$index];
        $detalle_cotizacion->update();
      }

      $this->generarPDFCotizacion($request, $cotizacion_id);

      return redirect()
        ->route('tenant.cotizaciones')
        ->with('editar', 'ok');
    }
  }
}
