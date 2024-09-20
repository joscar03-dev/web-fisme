<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarEvento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombrelugar',
        'lema-ciudad',
        'direccion',
        'url_mapa',
        'img',
        'estado',

    ];
    public function lugaresturisticos()
    {
        return $this->hasMany(LugarTuristico::class, 'lugar_evento_id');
    }
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_lugars', 'lugar_evento_id', 'evento_id');
    }
   
}
