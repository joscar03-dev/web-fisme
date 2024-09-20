<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Inscripción</title>
</head>
<body>
    <h1>Confirmación de Inscripción</h1>
    <p>Estimado(a) {{ $registro->nombres }} {{ $registro->apellidos }},</p>
    <p>Su inscripción al evento "{{ $registro->evento->nombre_evento }}" ha sido confirmada.</p>
    <p>Detalles del evento:</p>
    <ul>
        <li>Fecha: {{ \Carbon\Carbon::parse($registro->evento->fecha_inicio)->format('d/m/Y') }}</li>
        <li>Lugar: {{ $registro->evento->lugar }}</li>
    </ul>
    <p>Por favor, presente este correo o el código QR adjunto al ingresar al evento.</p>
    <p>Gracias por su participación.</p>
</body>
</html>