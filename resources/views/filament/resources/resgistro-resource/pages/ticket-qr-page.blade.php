<x-filament-panels::page>
    <div class="max-w-2xl mx-auto">
        <div class="bg-gradient-to-r from-cyan-400 to-[#133E6B] p-1 rounded-lg shadow-lg">
            <div class="bg-white p-6 rounded-lg">
                <div class="flex justify-between items-center mb-6">
                  
                    <img src="/images/logo-small.png" alt="UNTRM Logo" class="h-12" />
                    <div class="text-sm text-gray-600">
                        <p>Fecha: {{ now()->format('d/m/Y') }}</p>
                        <p>Hora: {{ now()->format('H:i') }}</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-lg font-semibold text-[#133E6B] mb-2">Información del Asistente</h3>
                        <p class="text-gray-700"><strong>Nombre:</strong> {{ $this->record->nombres }}
                            {{ $this->record->apellidos }}</p>
                        <p class="text-gray-700"><strong>Documento:</strong> {{ $this->record->numero_documento }}</p>
                        <p class="text-gray-700"><strong>Email:</strong> {{ $this->record->email }}</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        {!! $this->getQRCode() !!}
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-semibold text-[#133E6B] mb-2">Detalles del Evento</h3>
                    <p class="text-gray-700"><strong>Nombre del Evento:</strong> {{ $this->record->evento->nombre }}</p>
                    <p class="text-gray-700"><strong>Fecha:</strong>
                        {{ \Carbon\Carbon::parse($this->record->evento->fecha_inicio)->format('d/m/Y') }}</p>
                    <p class="text-gray-700"><strong>Lugar:</strong> {{ $this->record->evento->lugar }}</p>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">Este ticket es personal e intransferible. Por favor, preséntelo al
                        ingresar al evento.</p>
                </div>

                <div class="mt-6 flex justify-center">
                    <button
                        class="bg-[#133E6B] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out"
                        onclick="window.print()">
                        Imprimir Ticket
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
