@extends("inicio.inicio")
@section("update")
    <form  action="{{ route('Productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ $producto->precio }}" class="form-control" required>
        </div>

        <div class="form-group">
            <img src="{{ asset('storage/' . $producto->ruta) }}" alt="car"/>
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
