<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosInscripcion extends Model
{
    use HasFactory;

    // Define los campos que se pueden asignar en masa
    protected $fillable = [
        'inscripcion_concurso_id',
        'tipo_documento_id',
        'ruta',
    ];

    // Relación con la tabla `inscripcion_concursos`
    public function inscripcionConcurso()
    {
        return $this->belongsTo(InscripcionConcurso::class, 'inscripcion_concurso_id');
    }

    // Relación con la tabla `tipo_documentos`
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
}
