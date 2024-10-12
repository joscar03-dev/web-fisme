
    @vite('resources/css/ticket-page.css')
    
    <div class="ticket-container">
        <div class="ticket-wrapper">
            <div class="ticket-content">
                <div class="ticket-border-top"></div>

                <!-- Información del evento -->
                <div class="event-info">
                    <h1 class="event-title">XI Congreso Internacional</h1>
                    <h2 class="event-subtitle">Ingeniería de Sistemas</h2>
                    <p class="event-date"><span>18-20 Nov</span> | <span>9:00am - 06:00pm</span></p>
                    <p class="event-location">Campus UNTRM</p>
                </div>

                <!-- Código QR -->
                <div class="qr-code">
                    <div class="qr-code-inner">
                        {!! $this->getQRCode() !!}
                    </div>
                </div>

                <!-- Información del Asistente -->
                <div class="attendee-info">
                    <h3>Información del Asistente</h3>
                    <p><strong>Nombre:</strong> {{ $this->record->nombres }} {{ $this->record->apellidos }}</p>
                    <p><strong>Documento:</strong> {{ $this->record->numero_documento }}</p>
                    <p><strong>Asistente:</strong> {{ $this->record->tipo_asistente }}</p>
                    <p><strong>Email:</strong> {{ $this->record->email }}</p>
                </div>

                <!-- Mensaje de advertencia -->
                <p class="ticket-notice">
                    Este ticket es personal e intransferible. Presente el código QR al ingresar al evento.
                </p>

                <!-- Botones de acción -->
                <div class="ticket-actions">
                    <button class="ticket-button" onclick="window.print()">
                        Imprimir Ticket
                    </button>

                    <form wire:submit.prevent="enviarCorreo">
                        <button type="submit" class="ticket-button">
                            Enviar a correo
                        </button>
                    </form>
                </div>

                <div class="ticket-border-bottom"></div>
            </div>
        </div>
    </div>

</x-filament-panels::page>
