<!doctype html>
<html lang="en" data-theme="white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Cursos</title>
</head>

<body class=" ">
<x-header></x-header>

{{--mostrar cursos--}}
<main class="p-5 min-h-screen">
    @role('Admin')
    <div class="mt-4 flex flex-row-reverse ">
        <a href="{{ route('Cursos.create') }}" class="btn btn-success">Agregar Curso</a>
    </div>
    @endrole

    <section class=" flex flex-row p-2 flex-wrap ">

        @foreach($cursos as $curso)
            <div class="card w-96 glass  m-3">
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
</body>
</html>
