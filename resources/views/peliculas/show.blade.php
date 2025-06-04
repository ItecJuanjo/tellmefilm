@extends('layouts.app')

@section('title', $pelicula->titulo)

@section('content')
{{-- Tarjeta de la película igual que la de reseñas --}}
<div class="mt-6 px-4">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-6">
        <div class="flex flex-row flex-wrap items-start gap-6">

            {{-- Imagen --}}
<div class="flex-shrink-0" style="width: 250px;">
                @if ($pelicula->imagen_path)
                    <img src="{{ asset('storage/' . $pelicula->imagen_path) }}"
                         alt="Póster de {{ $pelicula->titulo }}"
                         class="rounded-lg shadow-md w-[200px] h-[300px] object-cover">
                @else
                    <div class="w-[200px] h-[300px] bg-gray-200 flex items-center justify-center text-sm text-gray-500 rounded">
                        Sin imagen
                    </div>
                @endif
            </div>

            {{-- Detalles --}}
            <div class="flex-1 space-y-2">
                <h1 class="text-3xl font-titulo text-turquesa">{{ $pelicula->titulo }}</h1>
                <p><strong class="text-grisoscuro">Director:</strong> {{ $pelicula->director }}</p>
                <p><strong class="text-grisoscuro">Categoría:</strong> {{ $pelicula->categoria->nombre ?? 'Sin categoría' }}</p>
                <p><strong class="text-grisoscuro">Año:</strong> {{ $pelicula->año }}</p>
                <p><strong class="text-grisoscuro">Sinopsis:</strong> {{ $pelicula->sinopsis }}</p>

                {{-- Valoración media --}}
                <div>
                    <strong class="text-grisoscuro">Valoración media:</strong>
                    @if ($media)
                        <span class="text-yellow-500 ml-1">
                            @for ($i = 1; $i <= 5; $i++)
                                {!! $media >= $i ? '★' : '☆' !!}
                            @endfor
                        </span>
                        <span class="ml-2 text-sm text-gray-600">({{ number_format($media, 1) }}/5)</span>
                    @else
                        <span class="text-sm text-gray-400">Sin valoraciones aún</span>
                    @endif
                </div>

                {{-- Botón solo si es admin --}}
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('peliculas.edit', $pelicula) }}"
                       class="inline-block mt-4 bg-naranja text-white px-4 py-2 rounded hover:bg-orange-600 transition">
                        ✏️ Editar Película
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<br>
<br>
{{-- Reseñas --}}
<div class="max-w-5xl mx-auto mt-12 px-4">
    <h2 class="text-2xl font-titulo text-grisoscuro border-naranja mb-8 text-center">
        🗣️ Reseñas de usuarios
    </h2>
    <br>

    @forelse ($resenas as $resena)
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6 max-w-2xl mx-auto border border-gray-100 text-center">
            <h4 class="text-base font-semibold text-grisoscuro">{{ $resena->usuario }}</h4>
            <span class="text-sm text-gray-500">{{ $resena->created_at->format('d M Y') }}</span>

            <div class="text-yellow-500 text-lg my-2">
                @for ($i = 1; $i <= 5; $i++)
                    {!! $resena->puntuacion >= $i ? '★' : '☆' !!}
                @endfor
            </div>

            <p class="text-gray-700 text-sm leading-relaxed">{{ $resena->contenido }}</p>
        </div>
    @empty
        <p class="text-center text-gray-500 italic">No hay reseñas aún para esta película.</p>
    @endforelse

    <div class="mt-6">
        {{ $resenas->links() }}
    </div>
</div>

{{-- Formulario reseña --}}
@if (auth()->check() && ! $pelicula->resenas->contains('usuario', auth()->user()->name))
    <div class="max-w-5xl mx-auto mt-12 px-4">
        <h3 class="text-xl font-titulo text-grisoscuro mb-4 text-center">🎬 Agregar Reseña</h3>

        <form method="POST" action="{{ route('resenas.store', $pelicula) }}" class="bg-white p-6 shadow-md rounded-xl space-y-6 border border-gray-200 max-w-2xl mx-auto">
            @csrf

            <div>
                <label for="puntuacion" class="block text-sm font-medium text-gray-700 mb-1 text-left">Puntuación (1-5)</label>
                <input type="number" id="puntuacion" name="puntuacion" min="1" max="5" required
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-turquesa focus:border-turquesa">
            </div>

            <div>
                <label for="contenido" class="block text-sm font-medium text-gray-700 mb-1 text-left">Comentario</label>
                <textarea id="contenido" name="contenido" rows="4" required
                          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-turquesa focus:border-turquesa"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-turquesa hover:bg-cyan-700 text-white font-semibold px-6 py-2 rounded shadow transition">
                    Enviar Reseña
                </button>
            </div>
        </form>
    </div>
@elseif (auth()->check())
    <div class="max-w-5xl mx-auto mt-6 text-sm text-red-500 px-4 text-center">
        Ya has dejado una reseña para esta película.
    </div>
@endif

{{-- Footer --}}
<footer class="bg-gray-100 mt-24 text-center py-6 border-t border-gray-200">
    <p class="text-sm text-gray-500">
        © {{ now()->year }} TellMeFilm · Desarrollado con ❤️ por <a href="#" class="text-turquesa hover:underline">Juan José Fuentes Rodríguez</a>
    </p>
    <p class="text-sm text-gray-500 mt-2">
        ¿Tienes alguna sugerencia o problema? <a href="mailto:itecjuanjo@gmail.com" class="text-naranja font-semibold hover:underline">Contáctame aquí</a>
    </p>
</footer>
@endsection
