<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'sinopsis', 'director', 'año', 'imagen_path', 'categoria_id', 'visitas'];


    // Relación con las reseñas
    public function resenas()
    {
        return $this->hasMany(Resena::class, 'pelicula_id');
    }
    
    public function categoria()
{
    return $this->belongsTo(Categoria::class);
}

}
