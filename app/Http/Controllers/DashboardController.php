<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Resena;

public function index()
{
    return view('dashboard.index', [
        'peliculasCount' => Pelicula::count(),
        'categoriasCount' => Categoria::count(),
        'usuariosCount' => User::count(),
        'resenasCount' => Resena::count(),
        'ultimasPeliculas' => Pelicula::latest()->take(5)->get(),
        'ultimasResenas' => Resena::latest()->take(5)->with('user', 'pelicula')->get(),
    ]);
}
