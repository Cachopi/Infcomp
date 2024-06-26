<!doctype html>
<html lang="en" data-theme="white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite('resources/css/app.css')
    <title>Cursos</title>
</head>

<body class=" ">
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
{{--mostrar cursos--}}
<main class="p-5 min-h-screen">

    @role('Admin')
    <div class="mt-4 flex flex-row-reverse ">
        <a href="{{ route('Cursos.create') }}" class="btn btn-success">Agregar Curso</a>
    </div>
    @endrole

    {{-- Contenedor del buscador centrado --}}
    <div class="flex justify-center mt-4 mb-4">
        <input type="text" id="searchInput" placeholder="Buscar cursos..." class="p-2 border border-gray-300 rounded-md">
    </div>

    <section class="flex flex-row p-2 flex-wrap">
        @foreach($cursos as $curso)
            <div class="card w-96 glass m-3 curso" data-nombre="{{ $curso->nombre }}" data-descripcion="{{ $curso->descripcion }}" data-precio="{{ $curso->precio }}" data-ruta="{{ asset('storage/'.$curso->ruta) }}" onclick="openModal(this)">
                <figure class="p-2"><img src="{{asset('storage/'.$curso->ruta)}}" alt="{{$curso->nombre}}"/></figure>
                <div class="card-body">
                    <h2 class="card-title">{{$curso->nombre}}</h2>
                    <p>{{$curso->descripcion}}</p>
                    <h3 class="flex flex-row-reverse mb-2 text-red-700 font-bold">{{$curso->precio}} €</h3>

                    <div class="card-actions justify-end">
                        @role('Usuario')
                        <form action="{{ route('cesta.anadir', [$curso->id, 'tipo' => 'curso']) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary hover:bg-blue-500" type="submit">Añadir </button>
                        </form>
                        @endrole
                        @role('Admin')
                        <form action="{{route('Cursos.destroy',($curso->id))}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary bg-red-700 border-red-700  hover:bg-red-500">Eliminar</button>

                        </form>
                        <a href="{{ route('Cursos.edit', $curso->id) }}" class="btn btn-primary hover:bg-blue-500">Editar</a>
                        @endrole
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</main>

<x-footer></x-footer>

<script>
    // Función para filtrar cursos según el texto ingresado en el buscador
    document.getElementById('searchInput').addEventListener('input', function() {
        var filter = this.value.toLowerCase();
        var cursos = document.querySelectorAll('.curso');

        cursos.forEach(function(curso) {
            var nombre = curso.getAttribute('data-nombre').toLowerCase();
            if (nombre.includes(filter)) {
                curso.style.display = '';
            } else {
                curso.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
