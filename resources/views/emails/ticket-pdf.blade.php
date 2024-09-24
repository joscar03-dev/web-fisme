<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Inscripción</title>
</head>
<body>
    <h1>XI Congreso Internacional</h1>
    <h2>{{ $registro->evento->nombre_evento }}</h2>
    <p>Fecha: {{ $registro->evento->fecha_inicio }}</p>

    <!-- Código QR -->
    <div style="text-align: center;">
        @if (!empty($qrCodeBase64))
            <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR">
        @else
            <p>No se pudo generar el código QR.</p>
        @endif
    </div>

    <p>Nombre: {{ $registro->nombres }} {{ $registro->apellidos }}</p>
    <p>Documento: {{ $registro->numero_documento }}</p>
    <p>Email: {{ $registro->email }}</p>
</body>
</html>
