<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizadores extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'imagen',
        'correo_electronico',
        'telefono',
        'biografia_breve',
    ];

    protected $casts = [
        'imagen' => 'string'
    ];


    public function evento()
    {
        return $this->hasMany(Evento::class, 'organizador_id');
    }
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_has_organizadores');
    }
}
