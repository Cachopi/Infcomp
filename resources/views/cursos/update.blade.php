@extends("inicio.inicio")
@section("updateCursos")
    <div class="container flex justify-center flex-col items-center ">
    <h1>Editar Curso</h1>
    <form action="{{ route('Cursos.update', $curso->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-lg">
        @csrf
        @method('PUT')

        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $curso->nombre }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $curso->descripcion }}</textarea>
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-gray-700 text-sm font-bold mb-2">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ $curso->precio }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="horas" class="block text-gray-700 text-sm font-bold mb-2">Horas</label>
            <input type="number" name="horas" id="horas" value="{{ $curso->horas }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <img src="{{ asset('storage/' . $curso->ruta) }}" alt="Imagen del curso" class="mb-2">
            <label for="imagen" class="block text-gray-700 text-sm font-bold mb-2">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar</button>
        </div>
    </form>
    </div>

@endsection
