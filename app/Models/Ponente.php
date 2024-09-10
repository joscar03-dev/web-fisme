<?php

namespace App\Models;

use App\Filament\Resources\TemasResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'apellidos',
        'especialidad',
        'imagen',
        'institucion',
        'correo_electronico',
        'telefono',
        'logo_pais',
        'logo_instituccion',
        'biografia_breve',
        'tema_id'
    ];

    // Relación inversa con el modelo Tema
    public function tema()
    {
        return $this->belongsTo(Temas::class, 'tema_id' );
    }
}
