<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@500&display=swap" rel="stylesheet">

    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.png') }}" type="image/x-icon">

    @yield('css')

    <title>@yield('title')</title>
  </head>
  <body>
    <div class="error">
      <div class="error-content">
        @yield('image')
        @yield('message')
      </div>
      <div class="error-wave"></div>
    </div>
  </body>
</html>
