<li class="nav-item">
  <a href="#" class="nav-link">APP</a>
</li>
@if ((Auth::user()->rol_id === 1) && (Auth::user()->rol->nombre_rol === 'Administrador General'))
  <li class="nav-item">
    <a class="nav-link" href="{{ route('altaEmpresa') }}">Alta Empresa</a>
  </li>
@endif