<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=SICOE+UI:wght@400;700&display=swap" rel="stylesheet">
    <title>Ticket del Evento</title>

    <style>
        body {
            font-family: 'SICOE UI', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .ticket {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #ff3e1d;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #555;
        }
        .content {
            margin-bottom: 20px;
        }
        .content p {
            font-size: 18px;
            margin: 0;
            color: #333;
        }
        .content ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }
        .content ul li {
            font-size: 16px;
            margin-bottom: 5px;
            color: #555;
        }
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="header">
            <h1>Confirmación de Inscripción</h1>
            <p>Evento: <strong>{{ $record->evento->nombre }}</strong></p>
        </div>

        <div class="content">
            <p>Estimado(a) <strong>{{ $record->nombres }} {{ $record->apellidos }}</strong>,</p>
            <p>Gracias por inscribirte al evento. A continuación, encontrarás los detalles de tu inscripción:</p>

            <ul>
                <li><strong>Documento:</strong> {{ $record->numero_documento }}</li>
                <li><strong>Email:</strong> {{ $record->email }}</li>
                <li><strong>Fecha del Evento:</strong> {{ $record->evento->fecha }}</li>
            </ul>

            <p>Por favor, presenta este ticket con el código QR para acceder al evento:</p>
        </div>

        <div class="qr-code">
            {!! QrCode::size(200)->generate($record->numero_documento) !!}
        </div>

        <div class="footer">
            <p>Si tienes alguna pregunta, no dudes en contactarnos. ¡Te esperamos en el evento!</p>
            <p>Equipo de Eventos Fisme</p>
        </div>
    </div>
</body>

</html>
