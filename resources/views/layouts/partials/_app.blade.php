<div id="nav-options" class="nav-options">
  <li class="nav-element">
    <a href="{{ route('empresas') }}" class="nav-ancla">
      <img src="{{ asset('images/icons/icon-company.svg') }}" class="nav-icon" alt="Icono de empresas" title="Empresas" width="32">
      <span class="link-text">Empresas</span>
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