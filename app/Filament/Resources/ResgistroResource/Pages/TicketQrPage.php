<?php

namespace App\Filament\Resources\ResgistroResource\Pages;

use App\Filament\Resources\ResgistroResource;
use App\Models\Resgistro;
use Filament\Resources\Pages\Page;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketQrPage extends Page
{  public Resgistro $record;
    protected static string $resource = ResgistroResource::class;

    protected static string $view = 'filament.resources.resgistro-resource.pages.ticket-qr-page';
    public function mount(Resgistro $record) // Usa el método mount para obtener el registro
    {
        $this->record = $record;
    }

    public function getQRCode()
    {
        return QrCode::size(200)->generate($this->record->numero_documento);
    }
}
