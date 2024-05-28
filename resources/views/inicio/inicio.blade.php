<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/jquery.min.js') }}"></script>


    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Infcomp</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>
<x-header></x-header>
@if(Session::has('error'))
    <div id="error-popup" class="popup" style="display:none;">
        {{ Session::get('error') }}
    </div>
@endif
@if($errors->any())
    <div id="error-popup" class="popup">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

@if(Session::has('success'))
    <div id="success-popup" class="success-popup">
        {{ Session::get('success') }}
    </div>
@endif

<script>

    setTimeout(function() {
        document.querySelectorAll('.popup').forEach(function(element) {
            element.style.display = 'none';
        });
    }, 3000);

    setTimeout(function() {
        document.querySelectorAll('.success-popup').forEach(function(element) {
            element.style.display = 'none';
        });
    }, 3000);
</script>
<main class="flex flex-col justify-center items-center flex-1 m-10">


    <div class="container">
        @yield('content')
    </div>

    @yield('login')
    @yield('registro')
    @yield("formulario")
    @yield("formularioCursos")
    @yield("update")
    @yield("updateCursos")
    @yield("cesta_pagina")
    @yield("perfil")
    @yield("usuarios")
    @yield("crear_usuario")
    @yield('actualizar_usuario')
    @yield('mostrar_facturas')
    @yield('show_factura')
    @yield('facturas_perfil')
    @yield('paypal')
    @yield('usuario_cursos')
</main>
<x-footer></x-footer>
</body>
</html>
