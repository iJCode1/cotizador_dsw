<nav id="navv" class="navv">
  <ul class="navv-list">
    <div class="navv-menu">
      <li class="navv-element navv-hamburgerD">
        <img id="icon-hamburgerD" src="{{ asset('images/icons/icon-menu.svg') }}" class="navv-icon" alt="Menu" title="menu" width="32">
        <p class="link-text">Cotizacloud</p>
      </li>
      <li class="navv-element navv-hamburger">
        <img id="icon-hamburger" src="{{ asset('images/icons/icon-menu.svg') }}" class="navv-icon" alt="Menu" title="menu" width="32">
        <p>Cotizacloud</p>
      </li>
      {{-- <div id="nav-options" class="nav-options">
        <li class="nav-element">
          <a href="#" class="nav-link">
            <img src="{{ asset('images/icons/icon-servicios.svg') }}" class="nav-icon" alt="Servicios" title="Servicios" width="32">
            <span class="link-text">Productos y/o Servicios</span>
          </a>
        </li>
        <li class="nav-element">
          <a href="#" class="nav-link">
            <img src="{{ asset('images/icons/icon-empleados.svg') }}" class="nav-icon" alt="Empleados" title="Empleados" width="32">
            <span class="link-text">Empleados</span>
          </a>
        </li>
        <li class="nav-element">
          <a href="#" class="nav-link">
            <img src="{{ asset('images/icons/icon-cotizaciones.svg') }}" class="nav-icon" alt="Cotizaciones" title="Cotizaciones" width="32">
            <span class="link-text">Cotizaciones</span>
          </a>
        </li>
        <li class="nav-element">
          <a href="#" class="nav-link">
            <img src="{{ asset('images/icons/icon-unidad_de_medida.svg') }}" class="nav-icon" alt="Unidades de medida" title="Unidades de medida" width="32">
            <span class="link-text">Unidades de Medida</span>
          </a>
        </li>
        <li class="nav-element">
          <a href="#" class="nav-link">
            <img src="{{ asset('images/icons/icon-logout.svg') }}" class="nav-icon" alt="Cerrar Sesión" title="Cerrar Sesión" width="32">
            <span class="link-text">Cerrar Sesión</span>
          </a>
        </li>
      </div> --}}
      
      <!-- Authentication Links -->
      @if ( app(\Hyn\Tenancy\Environment::class)->hostname() )                  
        @if ( Auth::guard('cliente')->user() || Auth::user() )
          @if ( Auth::guard('cliente')->user() )
            @if (( Auth::guard('cliente')->user()->rol->nombre_rol === "Cliente" ))
              @include('layouts.partials.tenant._cliente')
            @endif
            {{-- @include('layouts.partials._logout', ['authName' => Auth::guard('cliente')->user()->nombre]) --}}
          @endif

          @if ( Auth::user() )                              
            @if ((Auth::user()->rol->nombre_rol === "Administrador Empresa"))
              @include('layouts.partials.tenant._adminEmpresa')
            @endif

            @if ((Auth::user()->rol->nombre_rol === "Empleado"))
              @include('layouts.partials.tenant._empleado')
            @endif
            {{-- @include('layouts.partials._logout', ['authName' => Auth::user()->nombre]) --}}

          @endif
        @else
          <li class="navv-item">
            <a class="navv-link" href="{{ route('tenant.login') }}">{{ __('Login') }}</a>
          </li>
          
          <li class="navv-item">
            <a class="navv-link" href="{{ route('tenant.register') }}">{{ __('Registrarse') }}</a>
          </li>
      @endif
    @else
      @guest
        <li class="navv-item">
          <a class="navv-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
      @else
        @if ((Auth::user()->rol->nombre_rol === "Administrador General"))
          @include('layouts.partials._app')
        @endif

        {{-- @include('layouts.partials._logout', ['authName' => Auth::user()->name]) --}}
      @endguest
    @endif
    </div>
  </ul>
</nav>