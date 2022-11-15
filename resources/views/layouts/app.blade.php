<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    
    {{-- <link href="{{ asset('css/@yield('style')') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/login.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    {{-- Alpine --}}
    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>

    <link
    {{-- href="https://code.jquery.com/ui/1.12.1/themes/hot-sneaks/jquery-ui.css" --}}
    {{-- href="https://code.jquery.com/ui/1.13.2/themes/cupertino/jquery-ui.css" --}}
    href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
      rel="stylesheet"
    />

</head>
<body>
    <div id="app" class="container-app">
      {{-- {{dd($user[0])}} --}}
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if ( app(\Hyn\Tenancy\Environment::class)->hostname() )
                          
                          @if ( Auth::guard('cliente')->user() || Auth::user() )

                              @if ( Auth::guard('cliente')->user() )

                                @if (( Auth::guard('cliente')->user()->rol->nombre_rol === "Cliente" ))
                                  @include('layouts.partials.tenant._cliente')
                                @endif

                                @include('layouts.partials._logout', ['authName' => Auth::guard('cliente')->user()->nombre])

                              @endif
                              
                              @if ( Auth::user() )
                                                                  
                                @if ((Auth::user()->rol->nombre_rol === "Administrador Empresa"))
                                  @include('layouts.partials.tenant._adminEmpresa')
                                @endif

                                @if ((Auth::user()->rol->nombre_rol === "Empleado"))
                                  @include('layouts.partials.tenant._empleado')
                                @endif

                                @include('layouts.partials._logout', ['authName' => Auth::user()->nombre])

                              @endif
                          @else

                              <li class="nav-item">
                                <a class="nav-link" href="{{ route('tenant.login') }}">{{ __('Login') }}</a>
                              </li>
                              
                              <li class="nav-item">
                                <a class="nav-link" href="{{ route('tenant.register') }}">{{ __('Registrarse') }}</a>
                              </li>
                              
                          @endif
                        @else

                            @guest
                              <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                              </li>
                            @else
                              @if ((Auth::user()->rol->nombre_rol === "Administrador General"))
                                @include('layouts.partials._app')
                              @endif

                              @include('layouts.partials._logout', ['authName' => Auth::user()->name])
                            @endguest
                        @endif
                        
                    </ul>
                </div>
            </div>
        </nav> --}}

        @include('layouts.partials._navbar')

        {{-- Sweet Alert 2 --}}
        <script src="{{asset('./js/app.js')}}"></script>

        <!-- jQuery -->
        <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"
        ></script>

        <!-- jQuery UI -->
        <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
        ></script>

        <main class="main-app">
          @yield('content')
        </main>
    </div>
    <script src="{{asset('./js/navbar.js')}}"></script>
</body>
</html>
