<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Productos</title>

</head>
<body >
<x-header></x-header>
<main class="p-5">
    <div class="mt-4 flex flex-row-reverse ">
        <a href="{{ route('Productos.create') }}" class="btn btn-success">Agregar Producto</a>
    </div>

    <section class=" flex flex-row p-2 flex-wrap">


        @foreach($productos as $producto)
            <div class="card w-96 glass  m-3">
                <figure><img src="{{asset('storage/'.$producto->ruta)}}" alt="{{$producto->nombre}}"/></figure>
                <div class="card-body">
                    <h2 class="card-title">{{$producto->nombre}}</h2>
                    <p>{{$producto->descripcion}}</p>
                    <h3 class="flex flex-row-reverse mb-2 text-red-700 font-bold">{{$producto->precio}} €</h3>

                    <div class="card-actions justify-end">

                        <form action="{{ route('cesta.anadir', [$producto->id,'tipo'=>'producto']) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit">Añadir </button>
                        </form>
                        <form action="{{route('Productos.destroy',($producto->id))}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Eliminar</button>

                        </form>
                        <a href="{{ route('Productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>

                    </div>


                </div>
            </div>

        @endforeach


    </section>
</main>
<x-footer></x-footer>

</body>
</html>
