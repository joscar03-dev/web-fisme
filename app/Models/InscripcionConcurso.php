<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionConcurso extends Model
{
    use HasFactory;
    protected $fillable = [
        'concurso_id',
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellidos',
        'numero_celular',
        'tipo_participante',
        'institucion_procedencia',
        'email',
        'img_boucher',
        'concurso_id',
        'fecha_registro',
        'verificado',
        'usuario_verificacion',
        'fecha_verificacion',
        'estado',
    ];

    protected $dates = [
        'fecha_registro',
        'fecha_verificacion',
    ];

    // Relación con la tabla `concursos`
    public function concurso()
    {
        return $this->belongsTo(Concurso::class, 'concurso_id');
    }

    // Relación con la tabla `users` (usuario que verificó la inscripción)
    public function usuarioVerificacion()
    {
        return $this->belongsTo(User::class, 'usuario_verificacion');
    }

    // Relación con los documentos de inscripción
    public function documentosInscripcion()
    {
        return $this->hasMany(DocumentosInscripcion::class, 'inscripcion_concurso_id');
    }
}
