<!DOCTYPE html>
<html>
<head>
    <title>Recordatorio de Inscripción</title>
</head>
<body>
    <h1>{{ $data['titulo'] }}</h1>
    <p>{{ $data['mensaje'] }}</p>
    @if($data['qrCodeBase64'])
        <img src="data:image/png;base64,{{ $data['qrCodeBase64'] }}" alt="QR Code">
    @endif
    <p>Por favor, trae tu identificación y sigue las indicaciones para el evento.</p>
</body>
</html>
