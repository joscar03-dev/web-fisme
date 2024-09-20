<?php

namespace App\Filament\Resources\ResgistroResource\Pages;

use App\Filament\Resources\ResgistroResource;
use App\Mail\ConfirmacionInscripcionMailable;
use App\Models\Resgistro;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketQrPage extends Page
{  public ?Resgistro $record = null;
    protected static string $resource = ResgistroResource::class;
    protected static string $view = 'filament.resources.resgistro-resource.pages.ticket-qr-page';

    public function mount($record): void
    {
        $this->record = $record;
    }

    public function getQRCode()
    {if (!$this->record) {
        return '';
    }
    return QrCode::size(200)->generate($this->record->numero_documento);

    }

 
    public function enviarCorreo()
    {
        if (!$this->record) {
            Notification::make()
                ->title('Error')
                ->body('No se pudo encontrar el registro.')
                ->danger()
                ->send();
            return;
        }
    
        try {
            $qrCode = $this->getQRCode();
    
            Mail::to($this->record->email)
                ->send(new ConfirmacionInscripcionMailable($this->record));
    
            // Attach QR code after sending the email
            if ($qrCode) {
                $tempFile = tempnam(sys_get_temp_dir(), 'qr_code');
                file_put_contents($tempFile, $qrCode);
                
                Mail::to($this->record->email)
                    ->send((new ConfirmacionInscripcionMailable($this->record))
                        ->attach($tempFile, [
                            'as' => 'qr-code.png',
                            'mime' => 'image/png',
                        ]));
                
                unlink($tempFile);
            }
    
            $this->record->verificado = true;
            $this->record->save();
    
            Notification::make()
                ->title('Éxito')
                ->body('Correo enviado exitosamente y el estado de verificación ha sido actualizado.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Hubo un error al enviar el correo: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
 
