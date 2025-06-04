@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<h1 class="text-3xl font-titulo text-turquesa mb-4">Panel de Administración</h1>

{{-- Gestión de Categorías --}}
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-2">Gestión de Categorías</h2>
    <a href="{{ route('admin.categorias.create') }}" class="bg-naranja text-white px-4 py-2 rounded mb-4 inline-block">
        Añadir Categoría
    </a>

    <ul>
        @foreach ($categorias as $categoria)
            <li class="flex items-center justify-between mb-2">
                <span>{{ $categoria->nombre }}</span>
                <div>
                    <a href="{{ route('admin.categorias.edit', $categoria) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                    <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
    <h2 class="text-xl font-semibold mb-2 mt-6">Gestión de Películas</h2>
<a href="{{ route('admin.peliculas.create') }}" class="bg-naranja text-white px-4 py-2 rounded mb-4 inline-block">
    Añadir Película
</a>

<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead class="bg-turquesa text-white">
        <tr>
            <th class="py-2 px-4 text-left">Título</th>
            <th class="py-2 px-4 text-left">Categoría</th>
            <th class="py-2 px-4 text-left">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peliculas as $pelicula)
            <tr class="border-b">
                <td class="py-2 px-4">{{ $pelicula->titulo }}</td>
                <td class="py-2 px-4">{{ $pelicula->categoria ? $pelicula->categoria->nombre : 'Sin categoría' }}</td>
                <td class="py-2 px-4 flex gap-2">
                    <a href="{{ route('admin.peliculas.edit', $pelicula) }}" class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route('admin.peliculas.destroy', $pelicula) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
