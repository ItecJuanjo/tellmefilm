@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-6 py-8 bg-white">

    {{-- Lateral izquierdo --}}
    <aside class="md:col-span-1 space-y-8">
        @foreach ([
            'Más visitadas' => ['route' => 'peliculas.masVisitadas', 'items' => $masVisitadas ?? []],
            'Mejor valoradas' => ['route' => 'peliculas.mejorValoradas', 'items' => $mejores ?? []],
            'Peor valoradas' => ['route' => 'peliculas.peorValoradas', 'items' => $peores ?? []]
        ] as $tituloLateral => $data)
            <div class="bg-gray-50 border-l-4 border-turquesa p-4 rounded shadow-sm">
                <h2 class="text-lg font-titulo text-turquesa mb-2">
                    <a href="{{ route($data['route']) }}" class="hover:underline">{{ $tituloLateral }}</a>
                </h2>
                <ul class="space-y-1 text-sm text-grisoscuro">
                    @foreach($data['items'] as $pelicula)
                        <li>
                            <a href="{{ route('peliculas.show', $pelicula) }}" class="hover:underline">
                                → {{ $pelicula->titulo }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </aside>

    {{-- Contenido principal --}}
    <main class="md:col-span-3">
        <h1 class="text-3xl font-titulo text-grisoscuro mb-6 border-b-2 border-naranja inline-block pb-1">
            🎞️ {{ $titulo }}
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($peliculas as $pelicula)
                <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1 p-4 flex flex-col items-center text-center h-full">
                    <a href="{{ route('peliculas.show', $pelicula) }}">
                        @if ($pelicula->imagen_path)
                            <img src="{{ asset('storage/' . $pelicula->imagen_path) }}"
                                 alt="Póster de {{ $pelicula->titulo }}"
                                 class="object-cover rounded mb-3 shadow mx-auto"
                                 style="width: 160px; height: 240px;">
                        @else
                            <div class="w-[160px] h-[240px] bg-gray-200 flex items-center justify-center text-sm text-gray-500 rounded mb-3 mx-auto">
                                Sin imagen
                            </div>
                        @endif

                        <h3 class="text-lg font-semibold text-grisoscuro">{{ $pelicula->titulo }}</h3>
                        <p class="text-sm text-gray-500 mb-2">
                            {{ $pelicula->categoria->nombre ?? 'Sin categoría' }}
                        </p>

                        @php
                            $media = $pelicula->resenas()->avg('puntuacion');
                        @endphp

                        @if ($media)
                            <div class="flex justify-center items-center text-yellow-500 text-base">
                                @for ($i = 1; $i <= 5; $i++)
                                    {!! $media >= $i ? '★' : '☆' !!}
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">({{ number_format($media, 1) }}/5)</span>
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

        {{-- Paginación --}}
        <div class="mt-8 flex justify-center">
            {{ $peliculas->links() }}
        </div>
    </main>
</div>

{{-- Footer --}}
<footer class="bg-gray-100 mt-24 text-center py-6 border-t border-gray-200">
    <p class="text-sm text-gray-500">
        © {{ now()->year }} TellMeFilm · Desarrollado con ❤️ por
        <a href="#" class="text-turquesa hover:underline">Juan José Fuentes Rodríguez</a>
    </p>
    <p class="text-sm text-gray-500 mt-2">
        ¿Tienes alguna sugerencia o problema?
        <a href="mailto:itecjuanjo@gmail.com" class="text-naranja font-semibold hover:underline">Contáctame aquí</a>
    </p>
</footer>
@endsection
