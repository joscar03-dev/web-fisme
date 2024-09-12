<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_tema',
        'slug',
        'evento_id',
        'descripcion_tema',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'imagen'
   
    ];

    // Relación con el modelo Ponente
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id',);
    }

    // Relación uno a muchos con Ponente
    public function ponentes()
    {
        return $this->hasMany(Ponente::class , 'tema_id');
    }
    
}
