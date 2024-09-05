<?php

namespace App\Models;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resgistro extends Model
{
    use HasFactory;
    protected $fillable=[
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellidos',
        'numero_celular',
        'tipo_asistente',
        'institucion_procedencia',
        'email',
        'img_boucher',
        'evento_id',
        'verificado',
        'estado'


    ];
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
      // Método para generar el QR a partir del número de documento
      public function generateQrCode()
      {
          return QrCode::size(200)->generate($this->numero_documento);
      }

}
