<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        $roles = Role::all(); // Obtener todos los roles

        return view('usuarios.usuarios', compact('users','roles'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->role_id);

        return redirect()->route('Usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('usuarios.update', compact('user', 'roles'));
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->roles()->sync([$request->role_id]); // Cambiar roles

        return redirect()->route('Usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('Usuarios.index')->with('success', 'El usuario ha sido eliminado correctamente.');
    }

}
