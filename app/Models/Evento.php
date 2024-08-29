<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_evento',
        'tema_id',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_salida',
        'lugar',
        'tipo_evento',
        'area_evento',
        'organizador',
        'descripcion_breve',
        'precio_inscripcion',
        'imagen_banner',
        'video_banner',
        'organizador_id',
        'enlace_inscripcion'
    ];

    public function scopeUpcoming(Builder $query)
    {
        return $query->where('fecha_inicio', '>', now())->orderBy('fecha_inicio');
    }

    /**
     * Scope a query to only include featured events.
     */
    public function scopeFeatured(Builder $query)
    {
        return $query->where('tipo_evento', 'destacado'); // O ajusta según tu lógica.
    }

    
}
