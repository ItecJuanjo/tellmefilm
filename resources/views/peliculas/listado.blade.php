@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-2xl font-titulo text-turquesa mb-6">{{ $titulo }}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($peliculas as $pelicula)
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition text-center p-4">
                <a href="{{ route('peliculas.show', $pelicula) }}">
                    @if ($pelicula->imagen_path)
                        <img src="{{ asset('storage/' . $pelicula->imagen_path) }}"
                             alt="Póster de {{ $pelicula->titulo }}"
                             class="mx-auto max-h-48 object-cover rounded mb-2">
                    @else
                        <div class="w-24 h-36 mx-auto bg-gray-200 flex items-center justify-center text-sm text-gray-500 rounded mb-2">
                            Sin imagen
                        </div>
                    @endif

                    <h3 class="text-base font-semibold text-grisoscuro">{{ $pelicula->titulo }}</h3>
                    <p class="text-sm text-gray-500 mb-1">
                        {{ $pelicula->categoria->nombre ?? 'Sin categoría' }}
                    </p>

                    @php
                        $media = $pelicula->resenas()->avg('puntuacion');
                    @endphp

                    @if ($media)
                        <div class="flex justify-center items-center text-yellow-500 text-sm">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($media >= $i)
                                    ★
                                @elseif ($media > $i - 1)
                                    ☆
                                @else
                                    ☆
                                @endif
                            @endfor
                            <span class="ml-1 text-gray-600">({{ number_format($media, 1) }}/5)</span>
                        </div>
                    @else
                        <p class="text-xs text-gray-400">Sin valoraciones aún</p>
                    @endif
                </a>
            </div>
        @empty
            <p class="text-gray-600">No hay películas disponibles.</p>
        @endforelse
    </div>

    <div class="mt-6 flex justify-center">
        {{ $peliculas->links() }}
    </div>
</div>
@endsection
