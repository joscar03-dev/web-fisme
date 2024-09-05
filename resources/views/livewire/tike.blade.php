<div class="ticket">
    <h1>Ticket para {{ $registro->nombres }} {{ $registro->apellidos }}</h1>
    <p>Número de Documento: {{ $registro->numero_documento }}</p>
    <p>Evento: {{ $registro->evento->nombre }}</p>
    
    <!-- Generar el QR -->
    <div>
        {!! $registro->generateQrCode() !!}
    </div>
</div>

