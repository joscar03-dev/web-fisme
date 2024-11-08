<?php

namespace App\Jobs;

use App\Mail\RecordatorioInscritos;
use App\Models\InscripcionConcurso;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class enviarRecordatorioInscritos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $inscripciones = InscripcionConcurso::all();
        foreach ($inscripciones as $inscripcion) {
            $dias_restantes = now()->diffInDays($inscripcion->fecha_evento);
            $data = [
                'titulo' => "¡Solo faltan $dias_restantes días para el congreso!",
                'mensaje' => 'Gracias por inscribirte. Te recordamos que el evento está próximo.',
                'qrCodeBase64' => $inscripcion->qr_code, // QR recuperado de la base de datos
            ];
            Mail::to($inscripcion->email)->send(new RecordatorioInscritos($data));
        }
    }
}
