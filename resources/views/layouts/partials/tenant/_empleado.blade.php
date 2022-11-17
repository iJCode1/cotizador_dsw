<div id="navv-options" class="navv-options">
  <li class="navv-element">
    <a href="{{ route('tenant.showServicios') }}" class="navv-ancla">
      <img src="{{ asset('images/icons/icon-servicios.svg') }}" class="navv-icon" alt="Icono de servicios" title="Servicios" width="32">
      <span class="link-text">Productos y/o Servicios</span>
    </a>
  </li>

  <li class="navv-element">
    <a href="{{ route('tenant.cotizaciones') }}" class="navv-ancla">
      <img src="{{ asset('images/icons/icon-cotizaciones.svg') }}" class="navv-icon" alt="Icono de cotizaciones" title="Cotizaciones" width="32">
      <span class="link-text">Cotizaciones</span>
    </a>
  </li>

  <li class="navv-element">
    <a href="{{ route('tenant.unidades') }}" class="navv-ancla">
      <img src="{{ asset('images/icons/icon-unidad_de_medida.svg') }}" class="navv-icon" alt="Icono de unidades de medida" title="Unidades de medida" width="32">
      <span class="link-text">Unidades de Medida</span>
    </a>
  </li>

  <li class="navv-element">
    <a class="navv-ancla" href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
        <img src="{{ asset('images/icons/icon-logout.svg') }}" class="navv-icon" alt="Icono de cerrar sesión" title="Cerrar sesión" width="32">
        <span class="link-text">Cerrar Sesión</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </li>
</div>