<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite('resources/css/app.css')
    <title>Productos</title>
</head>
<body>
<x-header></x-header>
<main class="p-5">
    <div class="flex justify-center mb-4">
        <input type="text" id="searchInput" placeholder="Buscar productos..." class="input input-bordered w-full max-w-xs">
    </div>
    @role('Admin')
    <div class="mt-4 flex flex-row-reverse">
        <a href="{{ route('Productos.create') }}" class="btn btn-success">Agregar Producto</a>
    </div>
    @endrole
    <section class="flex flex-row p-2 flex-wrap">
        @foreach($productos as $producto)
            <div class="card w-96 glass m-3 producto" data-nombre="{{ $producto->nombre }}">
                <figure><img src="{{asset('storage/'.$producto->ruta)}}" alt="{{$producto->nombre}}"/></figure>
                <div class="card-body">
                    <h2 class="card-title">{{$producto->nombre}}</h2>
                    <p>{{$producto->descripcion}}</p>
                    <h3 class="flex flex-row-reverse mb-2 text-red-700 font-bold">{{$producto->precio}} €</h3>
                    @role('Admin')
                    <h3 class="flex flex-row-reverse mb-2 text-red-700 font-bold">Stock: {{$producto->stock}} UD</h3>
                    @endrole
                    <div class="card-actions justify-end">
                        @role('Usuario')
                        <form action="{{ route('cesta.anadir', [$producto->id,'tipo'=>'producto']) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary hover:bg-blue-500" type="submit">Añadir</button>
                        </form>
                        @endrole
                        @role('Admin')
                        <form action="{{route('Productos.destroy',($producto->id))}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary bg-red-700 border-danger-700 hover:bg-red-500">
                                Eliminar
                            </button>
                        </form>
                        <a href="{{ route('Productos.edit', $producto->id) }}" class="btn btn-primary hover:bg-blue-500">Editar</a>
                        @endrole
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</main>
<x-footer></x-footer>
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        var filter = this.value.toLowerCase();
        var productos = document.querySelectorAll('.producto');

        productos.forEach(function(producto) {
            var nombre = producto.getAttribute('data-nombre').toLowerCase();
            if (nombre.includes(filter)) {
                producto.style.display = '';
            } else {
                producto.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
