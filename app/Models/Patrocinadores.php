<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrocinadores extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'imagen',
        'correo_electronico',
        'biografia_breve',
    ];
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_has_patrocinadores');
    }
}
