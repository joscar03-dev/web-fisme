<?php

namespace App\Mail;

use App\Models\Resgistro;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
    public $qrCodeBase64;

    public function __construct(Resgistro $registro)
    {
        $this->registro = $registro;
        // $this->pdf = Pdf::loadView('emails.ticket-pdf', ['registro' => $this->registro])->output();
        $this->qrCodeBase64 = $this->getQRCode1(true);

        // Generar el PDF basado en la vista del ticket
        $this->pdf = Pdf::loadView('emails.ticket-pdf', [
            'registro' => $this->registro,
            'qrCodeBase64' => $this->qrCodeBase64, // Pasamos el código QR como Base64 a la vista
        ])->output();
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
    public function getQRCode1($forPdf = false)
    {
        if (!$this->registro) {
            return '';
        }

        if ($forPdf) {
            return base64_encode(QrCode::format('png')->size(200)->generate($this->registro->numero_documento));
        }

        return QrCode::size(200)->generate($this->registro->numero_documento);
    }
}
