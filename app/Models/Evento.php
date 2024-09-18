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
        return 'slug';
    }

    public function scopeUpcoming($query)
    {
        return $query->where('fecha_inicio', '>=', Carbon::now());
    }
    public function attendees()
    {
        return $this->morphToMany(User::class, 'attendable'); // Asegúrate de que esto esté bien configurado
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
    public function precios()
    {
        return $this->belongsToMany(Precio::class, 'evento_precios', 'evento_id', 'precio_id');
    }
    public function tematicas()
    {
        return $this->belongsToMany(Tematica::class, 'tematica_eventos', 'evento_id', 'tematica_id');
    }
    public function lugar()
    {
        return $this->belongsToMany(LugarEvento::class, 'evento_lugars', 'evento_id', 'lugar_evento_id');
    }
    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'evento_partners', 'evento_id', 'partner_id');
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
