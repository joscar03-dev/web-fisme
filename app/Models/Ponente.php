<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'especialidad',
        'imagen',
        'institucion',
        'correo_electronico',
        'telefono',
        'biografia_breve',
    ];

    // Relación inversa con el modelo Tema
    public function temas()
    {
        return $this->hasMany(Temas::class, 'ponente_id');
    }
}
