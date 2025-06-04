<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Categoria;

class AdminController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        $categorias = Categoria::all();
        return view('admin.index', compact('peliculas', 'categorias'));
    }
    public function dashboard()
{
    $latestMovies = Pelicula::latest()->take(5)->get();

    $mostVisited = Pelicula::where('created_at', '>=', now()->subDays(7))
                        ->orderByDesc('views')
                        ->take(5)
                        ->get();

    $bestRated = Pelicula::withAvg('resenas', 'rating')
                      ->whereHas('resenas', function ($q) {
                          $q->where('created_at', '>=', now()->subDays(7));
                      })
                      ->orderByDesc('resenas_avg_rating')
                      ->take(5)
                      ->get();

    $worstRated = Pelicula::withAvg('resenas', 'rating')
                       ->whereHas('resenas', function ($q) {
                           $q->where('created_at', '>=', now()->subDays(7));
                       })
                       ->orderBy('resenas_avg_rating')
                       ->take(5)
                       ->get();

    return view('admin.dashboard', compact('latestMovies', 'mostVisited', 'bestRated', 'worstRated'));
}


}
