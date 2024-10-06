<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosConcurso extends Model
{
    use HasFactory;
    protected $table = 'documentos_concursos';

    // Define los campos que se pueden asignar en masa
    protected $fillable = [
        'consurso_id',
        'tipo_documento_id',
    ];

    // Relación con la tabla `consursos`
    public function concurso()
    {
        return $this->belongsTo(Concurso::class, 'consurso_id');
    }

    // Relación con la tabla `tipo_documentos`
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

}
