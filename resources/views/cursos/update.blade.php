@extends("inicio.inicio")
@section("updateCursos")
    <form  action="{{ route('Cursos.update', $curso->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $curso->nombre }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $curso->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ $curso->precio }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="horas">Horas</label>
            <input type="number" name="horas" id="horas" value="{{ $curso->horas }}" class="form-control" required>
        </div>

        <div class="form-group">
            <img src="{{ asset('storage/' . $curso->ruta) }}" alt="car"/>
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control-file">
        </div>


        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
