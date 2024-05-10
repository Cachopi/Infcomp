
@extends("inicio.inicio")
@section("formulario")


<div class="container flex justify-center flex-col items-center ">

    <h1 class="p-5">Crear Producto</h1>
    <form action="{{ route('Productos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-lg ">
        @csrf

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
            <input type="text" name="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
            <textarea name="descripcion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-gray-700 text-sm font-bold mb-2">Precio:</label>
            <input type="number" name="precio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">Stock:</label>
            <input type="number" name="stock" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>


        <div class="mb-4">
            <label for="imagen" class="block text-gray-700 text-sm font-bold mb-2">Imagen:</label>
            <input type="file" name="imagen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Crear Producto</button>
        </div>
    </form>

</div>
@endsection
