@extends("inicio.inicio")
@section("titulo")
    Register
@endsection
@section("registro")
    <div class="flex items-center justify-center h-full p-5 rounded-2xl">
        <div class="w-full max-w-md h-full">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
                  class="bg-white shadow-md rounded px-8 pt-2  mb-4">


                @csrf
                <!-- Fotografia -->
                <div class="mt-4">
                    <label for="foto_perfil">Foto de Perfil</label>
                    <input id="foto_perfil" class="block mt-1 w-full" type="file" name="foto_perfil"  />
                </div>


                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                  required autofocus autocomplete="name"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                  :value="old('email')" required autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')"/>

                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirme Contraseña')"/>

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                       href="{{ route('login') }}">
                        {{ __('Ya estas Registrado?') }}
                    </a>

                    <x-primary-button class="ms-4 m-5">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

@endsection
