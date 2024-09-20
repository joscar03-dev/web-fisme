<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarTuristico extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_lugar',
        'descripcion-corta',
        'direccion',
        'url_mapa',
        'lugar_evento_id',
        'img',
        'estados'

    ];

    public function lugareventos()
    {
        return $this->belongsTo(LugarEvento::class, 'lugar_evento_id',);
    }

}
