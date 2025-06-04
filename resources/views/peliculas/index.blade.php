@extends('layouts.app')

@section('title', 'Lista de Películas')

@section('content')
    <h1 class="text-3xl font-titulo text-turquesa mb-4">Películas</h1>

    {{-- Filtro de Categorías y Búsqueda --}}
    <form action="{{ route('peliculas.index') }}" method="GET" class="mb-4 flex items-center gap-2">
        <select name="categoria" class="border rounded px-3 py-1" onchange="this.form.submit()">
            <option value="">Todas las categorías</option>
            @foreach(App\Models\Categoria::all() as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
        
        <input class="border rounded px-3 py-1" type="text" name="buscar" placeholder="Buscar por título o director" value="{{ request('buscar') }}">
        <button class="bg-naranja text-white px-4 py-1 rounded hover:bg-orange-600 transition">Buscar</button>
    </form>

    <p>{{ $peliculas->total() }} resultado(s)</p>

    <a class="bg-naranja text-white px-4 py-2 rounded inline-block mb-4 hover:bg-orange-600 transition" href="{{ route('peliculas.create') }}">Añadir Película</a>

    {{-- Listado de Películas --}}
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($peliculas as $pelicula)
            <li class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition text-center">
                <a href="{{ route('peliculas.show', $pelicula) }}" class="block">
                    @if ($pelicula->imagen_path)
                        <img src="{{ asset('storage/' . $pelicula->imagen_path) }}"
                             alt="Póster de {{ $pelicula->titulo }}"
                             class="mx-auto mt-4 max-h-48 max-w-[140px] object-cover rounded">
                    @else
                        <div class="w-32 h-48 mx-auto mt-4 bg-gray-200 flex items-center justify-center text-gray-500 rounded">
                            Sin imagen
                        </div>
                    @endif
                    <div class="p-4">
                        <h2 class="text-base font-titulo text-turquesa hover:underline">{{ $pelicula->titulo }}</h2>
                        <p class="text-sm text-gray-500">
                            {{ $pelicula->categoria ? $pelicula->categoria->nombre : 'Sin categoría' }}
                        </p>
                    </div>
                </a>
            </li>
        @empty
            <li>No hay películas disponibles.</li>
        @endforelse
    </ul>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $peliculas->withQueryString()->links() }}
    </div>
@endsection
