@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
    <h1 class="text-2xl font-titulo text-turquesa mb-4">Editar Categoría</h1>

    <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-grisoscuro mb-1">Nombre de la Categoría</label>
            <input type="text" name="nombre" id="nombre" value="{{ $categoria->nombre }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-turquesa"
                   required>
        </div>
        <div class="text-right">
            <button type="submit" class="bg-naranja text-white px-4 py-2 rounded hover:bg-orange-600 transition">
                Actualizar Categoría
            </button>
        </div>
    </form>
</div>
@endsection
