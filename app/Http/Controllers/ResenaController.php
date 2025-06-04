<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ResenaController extends Controller
{
    public function store(Request $request, Pelicula $pelicula)
{
    $userName = Auth::user()->name;

    // Verificar si el usuario ya ha dejado una reseña para esta película
    $existe = $pelicula->resenas()->where('usuario', $userName)->exists();

    if ($existe) {
        return redirect()->route('peliculas.show', $pelicula)
                         ->with('error', 'Ya has dejado una reseña para esta película.');
    }

    $request->validate([
        'contenido' => 'required',
        'puntuacion' => 'required|integer|min:1|max:5'
    ]);

    Resena::create([
        'pelicula_id' => $pelicula->id,
        'usuario' => $userName,
        'contenido' => $request->contenido,
        'puntuacion' => $request->puntuacion
    ]);

    return redirect()->route('peliculas.show', $pelicula)
                     ->with('success', 'Reseña añadida con éxito.');
}

}
