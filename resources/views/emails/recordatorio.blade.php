
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Inscripción</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        ul {
            background-color: #ecf0f1;
            padding: 15px 30px;
            border-radius: 5px;
        }
        li {
            margin-bottom: 10px;
        }
        .highlight {
            font-weight: bold;
            color: #2980b9;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $data['titulo'] }}</h1>
        <p>Estimado(a) <span class="highlight">{{ $registro->nombres }} {{ $registro->apellidos }}</span>,</p>
        <p>{{ $data['mensaje'] }}</p>
        <p>Detalles del evento:</p>
        <ul>
            <li><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($registro->evento->fecha_inicio)->format('d/m/Y') }}</li>
            <li><strong>Lugar:</strong> {{ $registro->evento->lugar }}</li>
        </ul>
        <p>Por favor presente este código QR adjunto al ingresar al evento.</p>
        <p>Gracias por su participación.</p>
        <div class="footer">
            <p>Si tiene alguna pregunta, no dude en contactarnos.</p>
        </div>
    </div>
</body>
</html>
