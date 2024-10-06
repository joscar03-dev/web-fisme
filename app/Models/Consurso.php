<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consurso extends Model
{
    use HasFactory;
    protected $table = 'consursos';

    // Define los campos que pueden ser asignados en masa
    protected $fillable = [
        'nombre',
        'slug',
        'tipo_concurso',
        'fecha_inicio',
        'hora',
        'nombres_completos',
        'fecha_fin',
        'estado',
    ];

}
