<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tematica extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',

    ];
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'tematica_eventos', 'tematica_id', 'evento_id');
    }

}
