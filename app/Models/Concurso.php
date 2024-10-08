<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concurso extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'slug',
        'tipo_concurso',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];
    protected $dates = ['fecha_inicio', 'fecha_fin'];

    // Alternativamente, puedes usar $casts para definir el tipo
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];
    // Relación con documentos de concursos
    public function inscripciones()
    {
        return $this->hasMany(InscripcionConcurso::class, 'concurso_id');
    }

    // Relación con los precios del concurso
    public function precios()
    {
        return $this->hasMany(PrecioConcurso::class, 'concurso_id');
    }

    // Relación con los documentos del concurso
    public function documentosConcursos()
    {
        return $this->hasMany(DocumentosConcurso::class, 'concurso_id');
    }
}
