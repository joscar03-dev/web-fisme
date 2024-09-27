{{-- <x-filament-panels::page>
    @vite('resources/css/app.css')
    <div class="max-w-2xl mx-auto">
        <div class="bg-gradient-to-r from-cyan-400 to-[#133E6B] p-1 rounded-lg shadow-lg">
            <div class="bg-white p-6 rounded-lg">
                @if ($this->record)
                <!-- Información del logo y la fecha -->
                <div class="flex justify-between items-center mb-6">
                    <img src="/images/logo-small.png" alt="UNTRM Logo" class="h-12" />
                    <div class="text-sm text-gray-600">
                        <p>Fecha: {{ now()->format('d/m/Y') }}</p>
                        <p>Hora: {{ now()->format('H:i') }}</p>
                    </div>
                </div>

                <!-- Información del asistente y código QR -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-lg font-semibold text-[#133E6B] mb-2">Información del Asistente</h3>
                        <p class="text-gray-700"><strong>Nombre:</strong> {{ $this->record->nombres }} {{ $this->record->apellidos }}</p>
                        <p class="text-gray-700"><strong>Documento:</strong> {{ $this->record->numero_documento }}</p>
                        <p class="text-gray-700"><strong>Email:</strong> {{ $this->record->email }}</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        {!! $this->getQRCode() !!}
                    </div>
                </div>

                <!-- Detalles del evento -->
                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-semibold text-[#133E6B] mb-2">Detalles del Evento</h3>
                    <p class="text-gray-700"><strong>Nombre del Evento:</strong> {{ $this->record->evento->nombre_evento }}</p>
                    <p class="text-gray-700"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($this->record->evento->fecha_inicio)->format('d/m/Y') }}</p>
                    <p class="text-gray-700"><strong>Lugar:</strong> {{ $this->record->evento->lugar }}</p>
                </div>

                <!-- Mensaje de advertencia -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">Este ticket es personal e intransferible. Por favor, preséntelo al ingresar al evento.</p>
                </div>

                <!-- Botones de acción -->
                <div class="mt-6 flex justify-center">
                    <button class="bg-[#133E6B] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out" onclick="window.print()">
                        Imprimir Ticket
                    </button>

                    <form wire:submit.prevent="enviarCorreo">
                        <button type="submit" class="ml-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-300 ease-in-out">
                            Enviar a correo
                        </button>
                    </form>
                </div>
                @else
                <div class="text-center text-red-600">
                    <p>No se pudo cargar la información del registro.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page> --}}
<x-filament-panels::page>
    {{-- CAYOTOPA --}}
    {{-- @vite('resources/css/app.css')
    <div class="max-w-md mx-auto">
        <div class="bg-[#133E6B] p-1 rounded-lg shadow-2xl">
            <div class="bg-white p-6 rounded-lg relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-[#133E6B]"></div>
                
                <!-- Información del evento -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold text-[#133E6B] mb-2">XI Congreso Internacional</h1>
                    <h2 class="text-xl text-gray-700 font-semibold">Ingeniería de Sistemas</h2>
                    <p class="text-gray-700 mt-2"><span class="font-bold text-[#133E6B]">18-20 Nov</span> | <span class="font-bold text-[#133E6B]">9:00am - 06:00pm</span></p>
                    <p class="text-gray-600 italic">Campus UNTRM</p>
                </div>

                <!-- Código QR -->
                <div class="flex justify-center items-center mb-6">
                    <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                        {!! $this->getQRCode() !!}
                    </div>
                </div>

                <!-- Información del Asistente -->
                <div class="flex flex-col justify-center items-center mb-6 bg-gray-50 p-4 rounded-lg shadow-inner">
                    <h3 class="text-lg font-semibold text-[#133E6B] mb-2">Información del Asistente</h3>
                    <p class="text-gray-700"><strong>Nombre:</strong> {{ $this->record->nombres }} {{ $this->record->apellidos }}</p>
                    <p class="text-gray-700"><strong>Documento:</strong> {{ $this->record->numero_documento }}</p>
                    <p class="text-gray-700"><strong>Asistente:</strong> {{ $this->record->tipo_asistente }}</p>
                    <p class="text-gray-700"><strong>Email:</strong> {{ $this->record->email }}</p>
                </div>

                <!-- Mensaje de advertencia -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600 italic">Este ticket es personal e intransferible. Presente el código QR al ingresar al evento.</p>
                </div>

                <!-- Botones de acción -->
                <div class="mt-6 flex justify-center space-x-4">
                    <button class="bg-[#133E6B] text-white px-6 py-2 rounded-full hover:bg-opacity-90 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#133E6B] focus:ring-opacity-50" onclick="window.print()">
                        Imprimir Ticket
                    </button>

                    <form wire:submit.prevent="enviarCorreo">
                        <button type="submit" class="bg-[#133E6B] text-white px-6 py-2 rounded-full hover:bg-opacity-90 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#133E6B] focus:ring-opacity-50">
                            Enviar a correo
                        </button>
                    </form>
                </div>

                <div class="absolute bottom-0 left-0 w-full h-2 bg-[#133E6B]"></div>
            </div>
        </div>
    </div> --}}
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
