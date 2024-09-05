<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_tema',
        'descripcion_tema',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'ponente_id',
    ];

    // Relación con el modelo Ponente
    public function ponente()
    {
        return $this->belongsTo(Ponente::class, 'ponente_id');
    }
    public function eventos()
{
    return $this->belongsToMany(Evento::class, 'evento_has_temas', 'tema_id', 'evento_id');
}
}
