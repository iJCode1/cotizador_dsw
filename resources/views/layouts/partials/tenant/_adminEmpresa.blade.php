<div id="nav-options" class="nav-options">
  <li class="nav-element">
    <a href="{{ route('tenant.showServicios') }}" class="nav-ancla">
      <img src="{{ asset('images/icons/icon-servicios.svg') }}" class="nav-icon" alt="Icono de servicios" title="Servicios" width="32">
      <span class="link-text">Productos y/o Servicios</span>
    </a>
  </li>

  <li class="nav-element">
    <a href="{{ route('tenant.showEmpleados') }}" class="nav-ancla">
      <img src="{{ asset('images/icons/icon-empleados.svg') }}" class="nav-icon" alt="Icono de empleados" title="Empleados" width="32">
      <span class="link-text">Empleados</span>
    </a>
  </li>

  <li class="nav-element">
    <a href="{{ route('tenant.cotizaciones') }}" class="nav-ancla">
      <img src="{{ asset('images/icons/icon-cotizaciones.svg') }}" class="nav-icon" alt="Icono de cotizaciones" title="Cotizaciones" width="32">
      <span class="link-text">Cotizaciones</span>
    </a>
  </li>

  <li class="nav-element">
    <a href="{{ route('tenant.unidades') }}" class="nav-ancla">
      <img src="{{ asset('images/icons/icon-unidad_de_medida.svg') }}" class="nav-icon" alt="Icono de unidades de medida" title="Unidades de medida" width="32">
      <span class="link-text">Unidades de Medida</span>
    </a>
  </li>

  <li class="nav-element">
    <a class="nav-ancla" href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
        <img src="{{ asset('images/icons/icon-logout.svg') }}" class="nav-icon" alt="Icono de cerrar sesión" title="Cerrar sesión" width="32">
        <span class="link-text">Cerrar Sesión</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </li>
</div>