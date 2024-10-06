<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioConcurso extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_participante',
        'precio',
        'estado',
        'concurso_id',
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class, 'concurso_id');
    }
}
