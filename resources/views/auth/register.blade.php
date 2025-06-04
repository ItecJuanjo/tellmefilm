@extends('layouts.guest')

@section('title', 'Registrarse')

@section('content')
<div class="flex flex-col justify-center items-center min-h-screen bg-gray-100 px-4">

    <!-- Título -->
    <h1 class="text-3xl font-titulo text-turquesa mb-6">Crear cuenta</h1>

    <!-- Cuadro de registro -->
    <div class="w-full max-w-sm bg-white shadow-lg rounded-lg p-6">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full max-w-[280px] mx-auto border border-gray-300 rounded px-3 py-2 focus:ring-turquesa focus:border-turquesa block">
                @error('name')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full max-w-[280px] mx-auto border border-gray-300 rounded px-3 py-2 focus:ring-turquesa focus:border-turquesa block">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="w-full max-w-[280px] mx-auto border border-gray-300 rounded px-3 py-2 focus:ring-turquesa focus:border-turquesa block">
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full max-w-[280px] mx-auto border border-gray-300 rounded px-3 py-2 focus:ring-turquesa focus:border-turquesa block">
            </div>

            <button type="submit"
                class="w-full bg-naranja hover:bg-orange-600 text-white font-semibold py-2 rounded transition">
                Registrarse
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="text-turquesa hover:underline font-medium">Inicia sesión aquí</a>
        </p>
    </div>
</div>
@endsection
