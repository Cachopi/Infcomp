@extends('inicio.inicio')

@section('usuario_cursos')
    <div class="container mx-auto">
        <h1 class="mb-8 text-3xl text-center">Mis Cursos</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cursos as $curso)
                <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                    <img src="{{ Storage::url($curso->ruta) }}" class="w-full" alt="{{ $curso->nombre }}">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $curso->nombre }}</div>
                        <p class="text-gray-700 text-base">{{ $curso->descripcion }}</p>
                        <p class="text-gray-700 text-base">Progreso: {{ $curso->pivot->progreso }}%</p>
                        <div class="w-full bg-gray-300 rounded-full mt-2">
                            <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white rounded-full" style="width: {{ $curso->pivot->progreso }}%;">{{ $curso->pivot->progreso }}%</div>
                        </div>
                        <form action="{{ route('eliminar_curso_usuario', $curso->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Eliminar Curso
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
