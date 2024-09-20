<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficios extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'estado',

    ];
    public function precio()
    {
        return $this->belongsToMany(Precio::class,'precio_beneficios', 'beneficio_id', 'precio_id');
    }
}
