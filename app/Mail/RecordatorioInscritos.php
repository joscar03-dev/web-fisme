<?php

namespace App\Mail;

use App\Models\Resgistro;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecordatorioInscritos extends Mailable
{
    use Queueable, SerializesModels;

    public $registro;
    public $pdf;
    public $data;
    public $qrCodeBase64;

    /**
     * Create a new message instance.
     */
    public function __construct(Resgistro $registro, array $data)
    {
        $this->registro = $registro;
        $this->data = $data;
        $this->qrCodeBase64 = $this->getQRCode1(true);
        $this->pdf = Pdf::loadView('emails.ticket-pdf', [
            'registro' => $this->registro,
            'qrCodeBase64' => $this->qrCodeBase64,
        ])->output();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recordatorio Inscritos',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.recordatorio', // Vista para el correo de recordatorio
            with: [
                'registro' => $this->registro,
                'data' => $this->data,
            ],

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
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
