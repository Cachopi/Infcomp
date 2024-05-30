<header class="sticky top-0 z-10 bg-base-100 shadow-md">
    @php
        $usuarioId = auth()->id();
        $productos = Illuminate\Support\Facades\Session::get("productoSesion_{$usuarioId}", []);
        $cursos = Illuminate\Support\Facades\Session::get("cursoSesion_{$usuarioId}", []);
        $total = Illuminate\Support\Facades\Session::get("total_{$usuarioId}", 0);
        $cantidad = Illuminate\Support\Facades\Session::get("cantidad_{$usuarioId}", 0);

        $cantidad = 0;
        foreach ($productos as $producto) {
            $cantidad += $producto['cantidad'];
        }
        foreach ($cursos as $curso) {
            $cantidad += $curso['cantidad'];
        }
    @endphp

    <div class="navbar flex-wrap justify-between">
        <div class="flex items-center space-x-4">
            <a class="btn btn-ghost text-xl" href="{{ route('inicio') }}">Infcomp</a>
            <div class="hidden md:flex space-x-4">
                <a class="btn btn-ghost text-xl" href="{{ route('Productos.index') }}">Productos</a>
                <a class="btn btn-ghost text-xl" href="{{ route('Cursos.index') }}">Cursos</a>
                @role('Admin')
                <a class="btn btn-ghost text-xl" href="{{ route('Usuarios.index') }}">Usuarios</a>
                <a class="btn btn-ghost text-xl" href="{{ route('Facturas.index') }}">Facturas</a>
                @endrole
            </div>
        </div>

        <div class="flex items-center md:space-x-4">
            <div class="dropdown dropdown-end md:hidden">
                <button tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="{{ route('Productos.index') }}">Productos</a></li>
                    <li><a href="{{ route('Cursos.index') }}">Cursos</a></li>
                    @role('Admin')
                    <li><a href="{{ route('Usuarios.index') }}">Usuarios</a></li>
                    <li><a href="{{ route('Facturas.index') }}">Facturas</a></li>
                    @endrole
                </ul>
            </div>

            <div class="flex-none flex items-center space-x-4">
                @auth
                    @role('Usuario')

                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="badge badge-sm indicator-item">{{$cantidad}}</span>
                            </div>
                        </div>

                            <div class="dropdown-content card card-compact w-80 bg-base-100 shadow mt-3 ml mr-[-90%] z-[1]">
                            <div class="card-body ">
                                <h2 class="card-title">Tu Cesta</h2>
                                <div class="overflow-y-auto max-h-60">
                                    @foreach($productos as $producto)
                                        <div class="flex items-center py-2">
                                            <img class="w-12 h-12 object-cover rounded" src="{{asset('storage/'.$producto['ruta'])}}" alt="Product Image">
                                            <div class="ml-3">
                                                <h3 class="text-gray-900 font-semibold">{{$producto['nombre']}}</h3>
                                                <p class="text-gray-700 text-sm">{{$producto['precio']}}€</p>
                                                <p class="text-gray-700 text-sm">Cantidad: {{$producto['cantidad']}}</p>
                                            </div>
                                            <form action="{{ route('cesta.eliminar', $producto['id']) }}" method="POST" class="ml-auto">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-xs btn-error">X</button>
                                            </form>
                                        </div>
                                    @endforeach
                                    @foreach($cursos as $curso)
                                        <div class="flex items-center py-2">
                                            <img class="w-12 h-12 object-cover rounded" src="{{asset('storage/'.$curso['ruta'])}}" alt="Curso Image">
                                            <div class="ml-3">
                                                <h3 class="text-gray-900 font-semibold">{{$curso['nombre']}}</h3>
                                                <p class="text-gray-700 text-sm">{{$curso['precio']}}€</p>
                                                <p class="text-gray-700 text-sm">Cantidad: {{$curso['cantidad']}}</p>
                                            </div>
                                            <form action="{{ route('cesta.eliminarCurso', $curso['id']) }}" method="POST" class="ml-auto">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-error">X</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card-actions justify-between mt-2">
                                    <a href="{{ route('cesta.vaciar') }}" class="btn btn-xs btn-warning">Vaciar Cesta</a>
                                    <h3 class="text-gray-900 font-semibold">Total: {{ is_numeric($total) ? $total : "0" }}€</h3>
                                    <a href="{{route('cesta.mostrar')}}" class="btn btn-primary btn-xs">Comprar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endrole

                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{ auth()->user()->getFoto() }}" alt="Foto de Perfil" />
                            </div>
                        </div>
                        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <a class="justify-between" href="{{ route('profile.edit') }}">
                                    Perfil
                                </a>
                            </li>
                            @role('Usuario')
                            <li>
                                <a class="justify-between" href="{{ route('facturas.mostrar') }}">
                                    Facturas
                                </a>
                            </li>
                            <li>
                                <a class="justify-between" href="{{ route('mis-cursos') }}">
                                    Mis Cursos
                                </a>
                            </li>
                            @endrole
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
        </div>
    </div>
</header>
