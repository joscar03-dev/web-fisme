<?php

namespace App\Mail;

use App\Models\Resgistro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacionInscripcionMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $registro;

    public function __construct(Resgistro $registro)
    {
        $this->registro = $registro;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Inscripción',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmacion-inscripcion',
            with: [
                'registro' => $this->registro,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
