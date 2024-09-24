<?php

namespace App\Mail;

use App\Models\Resgistro;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacionInscripcionMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $registro;
    public $pdf;

    public function __construct(Resgistro $registro)
    {
        $this->registro = $registro;
        $this->pdf = Pdf::loadView('emails.ticket-pdf', ['registro' => $this->registro])->output();
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

    /* public function attachments(): array
    {
        return [
            [
                'data' => $this->pdf, // Aquí va el contenido del PDF
                'name' => 'ticket-inscripcion.pdf', // Nombre del archivo adjunto
                'mime' => 'application/pdf', // Tipo MIME del archivo
            ]
        ];
    } */
    public function attachments(): array
    {
        // En lugar de devolver un array de arrays, usa la clase Attachment que Laravel proporciona
        return [
            Attachment::fromData(fn() => $this->pdf, 'ticket-inscripcion.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
