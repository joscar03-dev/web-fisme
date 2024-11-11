<?php

namespace App\Jobs;

use App\Mail\RecordatorioInscritos;
use App\Models\Evento;
use App\Models\InscripcionConcurso;
use App\Models\Resgistro;
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
        //obtener la fecha de inicio del evento de la tabla o modelo Evento
        $evento = Evento::first();
        $fecha_inicio = $evento->fecha_inicio;

        $diasRestantes = now()->diffInDays($fecha_inicio, false); // false para obtener un valor negativo si ya pasó la fecha

        // Armar el mensaje con los días restantes
        $inscripciones = Resgistro::all(); // Obtiene todas las inscripciones

        foreach ($inscripciones as $inscripcion) {
            // Crear el array de datos para el correo, reemplazando X con $diasRestantes
            $data = [
                'titulo'   => "¡Solo faltan $diasRestantes días para el VI Congreso Internacional de Ingeniería de Sistemas!",
                'mensaje'  => 'Gracias por inscribirte. Te mantendremos informado sobre nuestras actualizaciones.',
                'nombre'   => $inscripcion->nombres,
            ];

            // Enviar el correo a cada inscrito
            Mail::to($inscripcion->email)->send(new RecordatorioInscritos($inscripcion, $data));
        }
    }
}
