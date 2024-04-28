
<header class="sticky top-0 z-10">
    @php $productos  = \Illuminate\Support\Facades\Session::get('productoSesion',[]);
 $cantidad=0;
    foreach ($productos as $producto) {
        $cantidad+=$producto['cantidad'];
    }
    $cursos = \Illuminate\Support\Facades\Session::get('cursoSesion',[]);

    foreach ($cursos as $curso) {
        $cantidad+=$curso['cantidad'];
    }

    @endphp

    <div class="navbar bg-base-100">
        <div class="flex-1">

            <a class="btn btn-ghost text-xl" href="{{ route('inicio') }}">Infcomp</a>

            @auth()
                <a class="btn btn-ghost text-xl" href="{{ route('Productos.index') }}">Productos</a>

                <a class="btn btn-ghost text-xl" href="{{ route('Cursos.index') }}">Cursos</a>

            @endauth
        </div>
        <div class="flex-none">
            @auth
                <div class="dropdown dropdown-end">

                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle" >

                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="badge badge-sm indicator-item">{{$cantidad}}</span>
                        </div>
                    </div>

                    {{--           prueba carrito         --}}

                    <div class="max-w-96 mx-auto mt-16 bg-white rounded-lg overflow-hidden md:max-w-lg border border-gray-400 mt-3 z-[1] card card-compact dropdown-content w-80 bg-base-100 shadow">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <h1 class="text-2xl font-semibold mb-5">Tu Cesta</h1>

{{----}}
                            <div class="container mx-auto mt-10 w-auto overflow-y-scroll h-[700px] ">




                                @foreach($productos as $producto)
                                    <div class="flex items-center py-5 px-8 border-b border-gray-200">
                                        <img class="w-16 h-16 object-cover rounded" src="{{asset('storage/'.$producto['ruta'])}}" alt="Product Image">
                                        <div class="ml-3">
                                            <h3 class="text-gray-900 font-semibold">{{$producto['nombre']}}</h3>
                                            <p class="text-gray-700 mt-1">{{$producto['precio']}}€</p>
                                            <p class="text-gray-700 mt-1">cantidad {{$producto['cantidad']}}</p>

                                        </div>
                                        <form action="{{ route('cesta.eliminar', $producto['id']) }}" method="POST">
                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="ml-auto py-2 px-4 bg-red-700 hover:bg-red-500 text-white rounded-lg">
                                                X
                                            </button>
                                        </form>
                                    </div>

                                @endforeach
                                @foreach($cursos as $curso)
                                    <div class="flex items-center py-5 px-8 border-b border-gray-200">
                                        <img class="w-16 h-16 object-cover rounded" src="{{asset('storage/'.$curso['ruta'])}}" alt="Product Image">
                                        <div class="ml-3">
                                            <h3 class="text-gray-900 font-semibold">{{$curso['nombre']}}</h3>
                                            <p class="text-gray-700 mt-1">{{$curso['precio']}}€</p>
                                            <p class="text-gray-700 mt-1">cantidad {{$curso['cantidad']}}</p>

                                        </div>

                                        <form action="{{ route('cesta.eliminarCurso', $curso['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-auto py-2 px-4 bg-red-700 hover:bg-red-500 text-white rounded-lg">
                                                X
                                            </button>
                                        </form>
                                    </div>
                                @endforeach



                            </div>
{{--                            --}}
                            <div class="mt-5">
                                <a href="{{ route('cesta.vaciar') }}" class="text-red-500 hover:text-red-700">Vaciar Cesta</a>
                            </div>


                        </div>
                        <div class="flex flex-col divide-y divide-gray-200">


                            {{--                            foreach--}}



                        </div>
                        <div class="flex items-center justify-between px-6 py-3 bg-gray-100">
                            <h3 class="text-gray-900 font-semibold">Total: {{ Session::get('total', 0) }}€</h3>
                            <a class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg"  href="{{route('cesta.mostrar')}}" >
                                Comprar
                            </a>
                        </div>
                    </div>
                    {{--                  fin prueba  --}}
                </div>


        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="{{ auth()->user()-> getFoto() }}" alt="Foto de Perfil" />
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a class="justify-between"   href=" {{route('profile.edit')}}">
                     Perfil
                    </a>
                </li>

                <li>
                    <form action="{{route("logout")}}" method="post">
                        @csrf
                        <button type="submit">Salir</button>
                    </form>
                </li>
            </ul>
        </div>
        @else
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                </div>
            @endauth
        </div>

</header>
