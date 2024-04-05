@extends("inicio.inicio")
@section("cesta_pagina")
<div class="bg-gray-100 bg-opacity-75 h-screen py-8 w-[80%] ">
    <div class="container mx-auto px-4 ">
        <h1 class="text-2xl font-semibold mb-4">Cesta</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    <table class="w-full">
                        <thead class="m-6">
                        <tr class="m-6 p-10">
                            <th class="text-left font-semibold">Producto</th>
                            <th class="text-left font-semibold">Precio</th>
                            <th class="text-left font-semibold">Cantidad</th>
                            <th class="text-left font-semibold">Total</th>
                        </tr>
                        </thead>
                        <tbody class="m-6">

                        @foreach($productosConCantidad as $producto)


                        <tr class="m-6 p-10">
                            <td class="py-4">
                                <div class="flex items-center">

                                    <img class="h-16 w-16 mr-4" src="storage/{{$producto['producto']->ruta}}" alt="Product image">
                                    <span class="font-semibold">{{$producto['producto']->nombre}}</span>
                                </div>
                            </td>
                            <td class="py-4">{{$producto['producto']->precio}}</td>
                            <td class="py-4">
                                <div class="flex items-center">

                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <form action="{{ route('cesta.restar', $producto['producto']->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="border rounded-md py-2 px-4 mr-2">-</button>
                                            </form>
                                            <span class="text-center w-8">{{ $producto['cantidad'] }}</span>
                                            <form action="{{ route('cesta.sumar', $producto['producto']->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="border rounded-md py-2 px-4 ml-2">+</button>
                                            </form>
                                        </div>
                                    </td>


                                </div>
                            </td>
                            <td class="py-4">{{$producto['subtotal'] }}€ </td>
                        </tr>

                        @endforeach
                        <!-- More product rows -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Recibo</h2>



                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold">{{$total}}€</span>
                    </div>
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Comprar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
