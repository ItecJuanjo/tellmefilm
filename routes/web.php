<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| Rutas públicas (restringidas por login)
|--------------------------------------------------------------------------
*/

// Página principal (home solo para usuarios autenticados)
Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// Vistas extendidas (más visitadas, mejor, peor)
Route::middleware('auth')->group(function () {
    Route::get('/peliculas/mas-visitadas', [PeliculaController::class, 'masVisitadas'])->name('peliculas.masVisitadas');
    Route::get('/peliculas/mejor-valoradas', [PeliculaController::class, 'mejorValoradas'])->name('peliculas.mejorValoradas');
    Route::get('/peliculas/peor-valoradas', [PeliculaController::class, 'peorValoradas'])->name('peliculas.peorValoradas');
});


/*
|--------------------------------------------------------------------------
| Películas y Reseñas (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('peliculas', PeliculaController::class);
    Route::post('peliculas/{pelicula}/resenas', [ResenaController::class, 'store'])->name('resenas.store');
});


/*
|--------------------------------------------------------------------------
| Perfil del usuario
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::post('/perfil', [ProfileController::class, 'update'])->name('perfil.update');
});


/*
|--------------------------------------------------------------------------
| Panel de administración (solo admins)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Gestión de categorías y películas desde el panel
    Route::resource('categorias', CategoriaController::class);
    Route::resource('peliculas', PeliculaController::class);
});


/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
*/



require __DIR__.'/auth.php';
