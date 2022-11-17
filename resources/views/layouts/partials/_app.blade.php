<div id="navv-options" class="navv-options">
  <li class="navv-element">
    <a href="{{ route('empresas') }}" class="navv-ancla">
      <img src="{{ asset('images/icons/icon-company.svg') }}" class="navv-icon" alt="Icono de empresas" title="Empresas" width="32">
      <span class="link-text">Empresas</span>
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