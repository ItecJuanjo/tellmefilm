@extends('layouts.guest')

@section('title', 'Iniciar sesión')

@section('content')
<div class="flex flex-col justify-center items-center min-h-screen bg-gray-100 px-4">

    <!-- Título fuera del cuadro -->
    <h1 class="text-3xl font-titulo text-turquesa mb-6">Iniciar sesión</h1>

    <!-- Cuadro de login -->
    <div class="w-full max-w-sm bg-white shadow-lg rounded-lg p-6">

        @if ($errors->any())
        <div class="mb-4 text-red-600 text-sm text-center">
            {{ $errors->first() }}
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input id="email" type="email" name="email" required autofocus
                    class="w-full max-w-[280px] mx-auto border border-gray-300 rounded px-3 py-2 focus:ring-turquesa focus:border-turquesa block">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="w-full max-w-[280px] mx-auto border border-gray-300 rounded px-3 py-2 focus:ring-turquesa focus:border-turquesa block">
            </div>

            <div class="flex justify-between items-center mb-4 text-sm max-w-[280px] mx-auto">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 mr-2">
                    Recuérdame
                </label>
                <a href="{{ route('password.request') }}" class="text-naranja hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <button type="submit"
                class="w-full bg-naranja hover:bg-orange-600 text-white font-semibold py-2 rounded transition">
                Iniciar sesión
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-turquesa hover:underline font-medium">Regístrate aquí</a>
        </p>
    </div>
</div>
@endsection
