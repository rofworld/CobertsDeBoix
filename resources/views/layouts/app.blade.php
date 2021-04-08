<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Utils Boix') }}</title>

    <!-- Scripts -->
    <!--
    <script src="{{ asset('js/app.js') }}" defer></script>
    -->


    <!-- Fonts -->
    <!--
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yesteryear&display=swap" rel="stylesheet">
    <!-- Styles -->
    <!--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  -->
  <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
  <link href="{{ asset('css/components.css') }}" rel="stylesheet" media="screen">
  <link href="{{ asset('css/screen.css') }}" rel="stylesheet" media="screen">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
  <nav id="site-nav" class="nav-smart">
    <div>
      <input type="checkbox" id="mobnav" name="mobnav" aria-hidden="true" hidden>
      <strong><label for="mobnav"><span class="symbol-list"></span><mark></mark></label></strong>
      <div hidden>
      <a class="site-logo" href="{{ url('/home')}}" title="Coberts de Boix">
        <img src="/images/logo.jpg" alt="Lemon Hill Logo" class="image-logo"><b>Utils Boix</b>
      </a>
      <a href="{{ url('/home')}}" title="Home" style="margin-left:275px;">Inicio</a>
      <a href="{{ url('/onlineShop')}}" title="Online Shop">Tienda Online</a>
      @guest



            @if (Route::has('login'))

            <a href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>

            @endif

            @if (Route::has('register'))

            <a href="{{ route('register') }}">{{ __('Registro') }}</a>

            @endif

        @else
            <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">{{ __('Cerrar Sesión') }}</a></li>
                                               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>

      @endguest



     </div>
   </div>
  </nav>
    <main id="page-main">


      @if (Auth::check() && Auth::user()->admin==true)
      <hr>
      <nav id="page-nav" class="nav-scroll">
      <div>
        <a href="/product_list_admin" title="Product List">Lista de productos</a>
        <a href="/product_creation_form" title="Create Product">Crear Producto</a>
        <a href="/list_orders" title="Orders">Pedidos</a>
       </div>
       </nav>
       <hr>
       @endif
@yield('content')

</main>

</body>
<footer id="page-footer">

    <div class="footer_label">
      <label>Siguenos en: </label>
    </div>

      <a href="http://facebook.com"><img src="/images/logo_facebook.png" alt="Facebook" class="icons" ></a>
      <a href="http://www.instagram.com"><img src="/images/icono_instagram.png" alt="Instagram" class="icons"></a>

    <div id="author">
      <label>Creada por Ricardo Belmonte</label>
    </div>
    <div class="footer_label">
      <label>Basada en Barcelona CSS y Laravel</label>
    </div>
    <div class="footer-notes">
      <label>Tel 000000000</label><label style="margin-left:20px;">utilsboix@gmail.com</label><a style="color:var(--color-white); margin-left:20px;">Nota Legal</a><a style="color:var(--color-white); margin-left:20px;">Condiciones de compra</a>
    </div>

</footer>
</html>
