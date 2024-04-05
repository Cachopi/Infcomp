
@extends("inicio.inicio")
@section("formulario")
<div class="container">
    <h1>Crear Producto</h1>

    <form action="{{ route('Productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" name="precio" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Producto</button>
    </form>
</div>
@endsection
