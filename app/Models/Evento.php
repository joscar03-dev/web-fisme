<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_evento',
        'slug',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_salida',
        'lugar',
        'tipo_evento',
        'area_evento',
        'descripcion_breve',
        'precio_inscripcion',
        'imagen_banner',
        'imagen_catalogo',
        'video_banner',
        'estado',
        'enlace_inscripcion'
    ];
    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
    ];
    public function getRouteKeyName()
    {
        return 'tipo_evento'; // O cualquier otro campo que estés usando para buscar
    }

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

    public function temas()
    {
        return $this->hasMany(Temas::class, 'evento_id'); // Asegúrate que 'evento_id' es la columna correcta
    }


    public function registros()
    {
        return $this->hasMany(Resgistro::class);
    }

    // Relación muchos a muchos con Organizador
    public function organizadores()
    {
        return $this->belongsToMany(Organizadores::class, 'evento_has_organizadores', 'evento_id', 'organizador_id');
    }

    // Relación muchos a muchos con Patrocinador
    public function patrocinadores()
    {
        return $this->belongsToMany(Patrocinadores::class, 'evento_has_patrocinadores', 'evento_id', 'patrocinador_id');
    }

    public function getHoraInicioAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }
    
    public function getHoraSalidaAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }
    
}
