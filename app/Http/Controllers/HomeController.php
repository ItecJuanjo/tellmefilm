<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;

class HomeController extends Controller
{
    public function index()
    {
        $ultimas = Pelicula::latest()->paginate(6);

        $masVisitadas = Pelicula::orderByDesc('visitas')->take(5)->get();

        $mejores = Pelicula::withAvg('resenas', 'puntuacion')
            ->orderByDesc('resenas_avg_puntuacion')
            ->take(4)->get();

        $peores = Pelicula::withAvg('resenas', 'puntuacion')
            ->orderBy('resenas_avg_puntuacion')
            ->take(4)->get();

        return view('home', compact('ultimas', 'masVisitadas', 'mejores', 'peores'));
    }
}
