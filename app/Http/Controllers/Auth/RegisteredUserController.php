<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto_perfil' => ['nullable', 'image'],
        ]);

        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('profile-photos', 'public');
        } else {
            $path = 'profile-photos/default.jpg';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto_perfil' => $path,
        ]);

        $this->assignRoleAndPermissions($user);
        event(new Registered($user));

        Auth::login($user);

        return redirect("inicio");
    }
    protected function assignRoleAndPermissions($user)
    {
        $user->assignRole('Usuario'); // Asignar el rol 'Usuario' al usuario creado
    }
}
