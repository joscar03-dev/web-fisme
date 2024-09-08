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
        'apellidos',
        'especialidad',
        'imagen',
        'institucion',
        'correo_electronico',
        'telefono',
        'logo_pais',
        'logo_instituccion',
        'biografia_breve',
    ];

    // Relación inversa con el modelo Tema
    public function temas()
    {
        return $this->hasMany(Temas::class, 'ponente_id');
    }
    public function temass()
    {
        return $this->belongsToMany(Temas::class, 'tema_has_ponentes');
    }
}
