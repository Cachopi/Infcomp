@extends('inicio.inicio')

@section('facturas_perfil')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Facturas de {{$user->name}}</h1>
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
                        <a href="{{ route('facturas.show', ['id' => $factura->id]) }}" class="btn btn-primary hover:bg-blue-500">Ver Detalles</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
