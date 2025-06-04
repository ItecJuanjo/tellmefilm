<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
    $this->middleware('admin')->except(['index', 'show', 'masVisitadas', 'mejorValoradas', 'peorValoradas']);
}

    public function index(Request $request)
{
    $query = Pelicula::query();

    // Aplicar el filtro de categoría
    if ($request->has('categoria') && $request->categoria) {
        $query->where('categoria_id', $request->categoria);
    }

    // Aplicar búsqueda si hay
    if ($request->has('buscar') && $request->buscar) {
        $query->where('titulo', 'like', '%' . $request->buscar . '%')
              ->orWhere('director', 'like', '%' . $request->buscar . '%');
    }

    $peliculas = $query->paginate(6);

    return view('peliculas.index', compact('peliculas'));
}

    


  public function show(Pelicula $pelicula)
{
    // Incrementar visitas
    $pelicula->increment('visitas');

    // Calcular media de puntuaciones
    $media = $pelicula->resenas()->avg('puntuacion');

    // Paginamos las reseñas (5 por página)
    $resenas = $pelicula->resenas()->latest()->paginate(5);

    return view('peliculas.show', [
        'pelicula' => $pelicula,
        'media' => $media,
        'resenas' => $resenas
    ]);
}





    public function create()
    {
        return view('peliculas.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'sinopsis' => 'required',
        'director' => 'required|string|max:255',
        'año' => 'required|integer',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'categoria_id' => 'required|exists:categorias,id'
    ]);

    $imagenPath = null;
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('peliculas', 'public');
    }

    Pelicula::create([
        'titulo' => $request->titulo,
        'sinopsis' => $request->sinopsis,
        'director' => $request->director,
        'año' => $request->año,
        'imagen_path' => $imagenPath,
        'categoria_id' => $request->categoria_id
    ]);

    return redirect()->route('peliculas.index')->with('success', 'Película añadida con éxito.');
}




    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', compact('pelicula'));
    }

    public function update(Request $request, Pelicula $pelicula)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'sinopsis' => 'required',
        'director' => 'required|string|max:255',
        'año' => 'required|integer',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'categoria_id' => 'required|exists:categorias,id'
    ]);

    $imagenPath = $pelicula->imagen_path;
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('peliculas', 'public');
    }

    $pelicula->update([
        'titulo' => $request->titulo,
        'sinopsis' => $request->sinopsis,
        'director' => $request->director,
        'año' => $request->año,
        'imagen_path' => $imagenPath,
        'categoria_id' => $request->categoria_id
    ]);

    return redirect()->route('peliculas.show', $pelicula)->with('success', 'Película actualizada con éxito.');
}


    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return redirect()->route('peliculas.index');
    }

    public function masVisitadas()
{
    $peliculas = Pelicula::orderByDesc('visitas')->paginate(9);
    return view('peliculas.listado', [
        'titulo' => 'Más visitadas',
        'peliculas' => $peliculas
    ]);
}

public function mejorValoradas()
{
    $peliculas = Pelicula::withAvg('resenas', 'puntuacion')
                    ->orderByDesc('resenas_avg_puntuacion')
                    ->paginate(9);

    return view('peliculas.listado', [
        'titulo' => 'Mejor valoradas',
        'peliculas' => $peliculas
    ]);
}

public function peorValoradas()
{
    $peliculas = Pelicula::withAvg('resenas', 'puntuacion')
                    ->orderBy('resenas_avg_puntuacion')
                    ->paginate(9);

    return view('peliculas.listado', [
        'titulo' => 'Peor valoradas',
        'peliculas' => $peliculas
    ]);
}


    

}

