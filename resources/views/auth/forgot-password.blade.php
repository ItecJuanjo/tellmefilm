@extends('layouts.guest')

@section('title', 'Recuperar contraseña')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-2xl font-titulo text-turquesa text-center mb-6">Recuperar contraseña</h1>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input id="email" type="email" name="email" required autofocus
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-turquesa focus:border-turquesa"
                       value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-naranja hover:bg-orange-600 text-white font-semibold py-2 rounded transition">
                Enviar enlace para restablecer
            </button>
        </form>
    </div>
</div>
@endsection
