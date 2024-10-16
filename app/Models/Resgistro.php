<?php

namespace App\Models;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resgistro extends Model
{
    use HasFactory;
    protected $table = 'registros';
    protected $fillable = [
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
        'estado',
        'usuario_verificacion',
        'tipo',
        'modalidad',
        'entidad_financiera',
        'fecha_pago',
        'n_comprobante',
        'monto',


    ];
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    // Relación opcional: Registro pertenece a un Usuario que lo verificó
    public function usuarioVerificacion()
    {
        return $this->belongsTo(User::class, 'usuario_verificacion');
    }
    // Método para generar el QR a partir del número de documento
    public function generateQrCode()
    {
        return QrCode::size(200)->generate($this->numero_documento);
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
    public function scopeSinVerificar($query)
    {
        return $query->where('verificado', false);
    }

    public static function contarSinVerificar()
    {
        return self::sinVerificar()->count();
    }
}
