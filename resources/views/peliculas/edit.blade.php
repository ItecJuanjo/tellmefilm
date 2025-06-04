@extends('layouts.app')

@section('title', 'Editar Película')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
    <h1 class="text-2xl font-titulo text-turquesa mb-4">Editar Película</h1>

    <form action="{{ route('peliculas.update', $pelicula) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Título --}}
        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-grisoscuro mb-1">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $pelicula->titulo) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-turquesa"
                   required>
        </div>

        {{-- Director --}}
        <div class="mb-4">
            <label for="director" class="block text-sm font-medium text-grisoscuro mb-1">Director</label>
            <input type="text" name="director" id="director" value="{{ old('director', $pelicula->director) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-turquesa"
                   required>
        </div>

        {{-- Año --}}
        <div class="mb-4">
            <label for="año" class="block text-sm font-medium text-grisoscuro mb-1">Año</label>
            <input type="number" name="año" id="año" value="{{ old('año', $pelicula->año) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-turquesa"
                   required>
        </div>

        {{-- Sinopsis --}}
        <div class="mb-4">
            <label for="sinopsis" class="block text-sm font-medium text-grisoscuro mb-1">Sinopsis</label>
            <textarea name="sinopsis" id="sinopsis" rows="4"
                      class="w-full border rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-turquesa"
                      required>{{ old('sinopsis', $pelicula->sinopsis) }}</textarea>
        </div>

        {{-- Imagen --}}
        <div class="mb-6">
            <label for="imagen" class="block text-sm font-medium text-grisoscuro mb-1">Imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0
                          file:text-sm file:font-semibold file:bg-naranja file:text-white hover:file:bg-orange-600">
        </div>

        {{-- Categoría --}}
        <div class="mb-4">
            <label for="categoria" class="block text-sm font-medium text-grisoscuro mb-1">Categoría</label>
            <select name="categoria_id" id="categoria" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-turquesa" required>
                <option value="">Seleccione una categoría</option>
                @foreach(App\Models\Categoria::all() as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == $pelicula->categoria_id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botón --}}
        <div class="text-right">
            <button type="submit"
                    class="bg-naranja text-white font-semibold px-6 py-2 rounded hover:bg-orange-600 transition">
                Actualizar Película
            </button>
        </div>
    </form>
</div>
@endsection
