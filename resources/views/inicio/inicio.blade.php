<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    @vite('resources/css/app.css')
    <title>Infcomp</title>

</head>
<body class="min-h-1/2">
<x-header></x-header>
<main class="flex justify-center items-center  m-40 ">

    @yield('login')
    @yield('registro')
    @yield("formulario")
    @yield("formularioCursos")
    @yield("update")
    @yield("updateCursos")
    @yield("cesta_pagina")


</main>
<x-footer></x-footer>
</body>
</html>
