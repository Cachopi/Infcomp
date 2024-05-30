@extends('inicio.inicio')
@section('mostrar_facturas')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Facturas</h1>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Usuario</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($facturas as $factura)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $factura->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $factura->total }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if ($factura->usuario)
                                    {{ $factura->usuario->name }}
                                @else
                                    Usuario no definido
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $factura->created_at }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('Facturas.show', ['Factura' => $factura->id]) }}" class="btn btn-primary hover:bg-blue-500">Ver Detalles</a>
                                    <a class="btn btn-primary bg-red-700 border-red-700 hover:bg-red-500" href="{{ route('Facturas.destroy', ['Factura' => $factura->id]) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $factura->id }}').submit();">Eliminar</a>
                                    <form id="delete-form-{{ $factura->id }}" action="{{ route('Facturas.destroy', ['Factura' => $factura->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
