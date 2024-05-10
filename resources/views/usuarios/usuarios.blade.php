
@extends("inicio.inicio")
@section('usuarios')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Lista de Usuarios
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('Usuarios.create') }}" class="btn btn-success">Crear Usuario</a>
                </div>
                <table class="table glass">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="w-2 "> <img class="rounded-full" src="{{asset('storage/'.$user->foto_perfil)}}"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }} <br> <!-- Mostrar el nombre de cada rol del usuario en una nueva línea -->
                                @endforeach
                            </td>
                            <td>
                                <!-- Enlaces para editar y eliminar usuarios -->
                                <a href="{{ route('Usuarios.show', $user->id) }}" class="btn btn-primary hover:bg-blue-500">Editar</a>
                                <form action="{{ route('Usuarios.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary bg-red-700 border-danger-700 hover:bg-red-500">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
