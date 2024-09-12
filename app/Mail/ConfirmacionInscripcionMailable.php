<?php

namespace App\Mail;

use App\Models\Resgistro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacionInscripcionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public Resgistro $resgistro;

    /**
     * Create a new message instance.
     */
    public function __construct(Resgistro $resgistro)
    {
        $this->resgistro = $resgistro;
    }

    /**
     * Build the message.
     */
    
    public function build()
    {
        return $this->view('emails.ticket-qr') // Vista del correo
            ->from(new Address($this->resgistro->email, $this->resgistro->evento->nombre_evento)) // Corregido: $this->resgistro
            ->subject('Confirmación de Inscripción al Evento') // Asunto del correo
            ->with([
                'record' => $this->resgistro, // Pasamos el registro a la vista
            ]);
    }
}
