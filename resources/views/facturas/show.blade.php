@extends('inicio.inicio')
@section('show_factura')

    <div class="container mx-auto">
      @role('Admin')  <h1 class="text-2xl font-bold mb-4">Detalles de la factura {{ $factura->id }}</h1>@endrole
        @role('Usuario')  <h1 class="text-2xl font-bold mb-4">Detalles de la factura </h1>@endrole


        <div class="overflow-x-auto">
            <table class="w-full whitespace-no-wrap bg-white border-gray-200 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Nombre</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Precio</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Cantidad</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Subtotal</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach ($factura->productos as $producto)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->precio }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->pivot->cantidad }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->precio * $producto->pivot->cantidad }}</td>
                    </tr>
                @endforeach
                @foreach ($factura->cursos as $curso)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $curso->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $curso->precio }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $curso->pivot->cantidad }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $curso->precio * $curso->pivot->cantidad }}</td>
                    </tr>
                @endforeach
                <tr class="font-bold">
                    <td colspan="3" class="px-6 py-4 text-right">Total:</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $factura->total }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
