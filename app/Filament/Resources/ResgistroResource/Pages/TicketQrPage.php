<?php

namespace App\Filament\Resources\ResgistroResource\Pages;

use App\Filament\Resources\ResgistroResource;
use App\Mail\ConfirmacionInscripcionMailable;
use App\Models\Resgistro;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketQrPage extends Page
{  public Resgistro $record;
    protected static string $resource = ResgistroResource::class;
    protected static string $view = 'filament.resources.resgistro-resource.pages.ticket-qr-page';

    public function mount(Resgistro $record)
    {
        $this->record = $record;
    }

    public function getQRCode()
    {
        return QrCode::size(200)->generate($this->record->numero_documento);
    }

    // Método para enviar el ticket por correo y actualizar el estado de verificación
    public function enviarCorreo()
    {
        try {
            // Enviar correo con la confirmación
            Mail::to($this->record->email)->send(new ConfirmacionInscripcionMailable($this->record));

            // Actualizar el estado de verificación en la base de datos
            $this->record->verificado = true;
            $this->record->save();
            // Mostrar un mensaje de éxito
            session()->flash('message', 'Correo enviado exitosamente y el estado de verificación ha sido actualizado.');

        } catch (\Exception $e) {
            // En caso de error, mostrar un mensaje de error
            session()->flash('error', 'Hubo un error al enviar el correo: ' . $e->getMessage());
        }
    }
}
 
