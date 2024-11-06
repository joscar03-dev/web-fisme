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
        $data = [
            'titulo' => '¡Solo faltan X dias para el congreso!',
            'mensaje' => 'Gracias por inscribirte. Te mantendremos informado sobre nuestras actualizaciones.',
        ];
        foreach ($inscripciones as $inscripcion) {
            Mail::to($inscripcion->email)->send(new RecordatorioInscritos($data));
        }
    }
}
