@extends('layouts.app')

@section('title', 'Añadir Película')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
    <h1 class="text-2xl font-titulo text-turquesa mb-4">Añadir Nueva Película</h1>

    <form action="{{ route('admin.peliculas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-grisoscuro mb-1">Título</label>
            <input type="text" name="titulo" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="categoria_id" class="block text-sm font-medium text-grisoscuro mb-1">Categoría</label>
            <select name="categoria_id" class="w-full border rounded px-3 py-2">
                <option value="">Seleccione una categoría</option>
                @foreach(App\Models\Categoria::all() as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="sinopsis" class="block text-sm font-medium text-grisoscuro mb-1">Sinopsis</label>
            <textarea name="sinopsis" rows="4" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div class="mb-4">
            <label for="imagen" class="block text-sm font-medium text-grisoscuro mb-1">Imagen</label>
            <input type="file" name="imagen" class="w-full">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-naranja text-white px-4 py-2 rounded hover:bg-orange-600 transition">
                Guardar Película
            </button>
        </div>
    </form>
</div>
@endsection
