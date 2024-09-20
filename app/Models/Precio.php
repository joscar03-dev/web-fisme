<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_asistente',
        'precio',
        'gratis',
        'estado',
    ];
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_precios', 'precio_id', 'evento_id');
    }
}