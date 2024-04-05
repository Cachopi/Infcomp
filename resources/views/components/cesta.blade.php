@extends("components.header")
@section("cesta")
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-semibold mb-5">Tu Cesta</h1>

        @foreach($productos as $producto)
            <div class="flex items-center py-5 px-8 border-b border-gray-200">
                <img class="w-16 h-16 object-cover rounded" src="{{ asset($producto->ruta) }}" alt="Product Image">
                <div class="ml-3">
                    <h3 class="text-gray-900 font-semibold">{{ $producto->nombre }}</h3>
                    <p class="text-gray-700 mt-1">{{ $producto->precio }}</p>
                </div>
                <form action="{{ route('cesta.eliminar', $producto->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ml-auto py-2 px-4 bg-red-700 hover:bg-red-500 text-white rounded-lg">
                        X
                    </button>
                </form>
            </div>
        @endforeach

        <div class="mt-5">
            <a href="{{ route('cesta.vaciar') }}" class="text-red-500 hover:text-red-700">Vaciar Cesta</a>
        </div>
    </div>

@endsection
