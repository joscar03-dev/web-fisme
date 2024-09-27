{{-- <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XI Congreso Internacional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .ticket {
            background-color: white;
            border: 2px solid #003366;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #003366;
            font-size: 20px;
            text-align: center;
            margin-top: 0;
        }

        h2 {
            color: #003366;
            font-size: 16px;
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            margin: 5px 0;
            font-size: 14px;
        }

        .qr-code {
            text-align: center;
            margin: 20px 0;
        }

        .qr-code img {
            width: 150px;
            height: 150px;
        }

        .info {
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button {
            background-color: #003366;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h1>{{ $registro->evento->nombre_evento }}</h1>
        <h2>Ingeniería de Sistemas</h2>
        <p><span><strong>{{ $registro->evento->fecha_inicio }}-{{ $registro->evento->fecha_fin }}</strong></span>
            |
            <span><strong>{{ $registro->evento->hora_inicio }}-{{ $registro->evento->hora_salida }}</strong></span>
        </p>
        <p class="location">Facultad de Ingeniera de Sistemas y Mecánica Eléctrica</p>
        <div class="qr-code">
            @if (!empty($qrCodeBase64))
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR">
            @else
                <p>No se pudo generar el código QR.</p>
            @endif
        </div>
        <div class="info">
            <h3>Información del Asistente</h3>
            <p><strong>Nombre:</strong>{{ $registro->apellidos }} {{ $registro->nombres }} </p>
            <p><strong>Documento:</strong> {{ $registro->numero_documento }}</p>
            <p><strong>Teléfono:</strong> {{ $registro->numero_celular }}</p>
            <p><strong>Asistente:</strong> {{ $registro->tipo_asistente }}</p>
            <p><strong>Institucion:</strong> {{ $registro->institucion_procedencia }}</p>
        </div>
        <p><em>Este ticket es personal e intransferible. Presente el código QR al ingresar al evento.</em></p>
        <div class="buttons">
            <button class="button">Imprimir Ticket</button>
            <button class="button">Enviar a correo</button>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$registro->evento->nombre_evento}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .ticket {
            background-color: white;
            border: 2px solid #003366;
            border-radius: 10px;
            padding: 20px;
            width: 50%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: auto;
        }
        h1 {
            color: #003366;
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 5px;
        }
        h2 {
            color: #003366;
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 10px;
        }
        p {
            margin: 5px 0;
            font-size: 14px;
        }
        .qr-code {
            margin: 20px 0;
        }
        .qr-code img {
            width: 200px;
            height: 200px;
        }
        .info {
            border-top: 1px solid #ccc;
            padding-top: 10px;
            text-align: center;
        }
        .note {
            font-style: italic;
            font-size: 12px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h1>{{ $registro->evento->nombre_evento }}</h1>
        <h2>{{ $registro->evento->lugar }}</h2>
        <p>
            <span><strong>{{ \Carbon\Carbon::parse($registro->evento->fecha_inicio)->format('d') }} - {{ \Carbon\Carbon::parse($registro->evento->fecha_fin)->format('d M') }}</strong></span>
            |
            <span><strong>{{ \Carbon\Carbon::parse($registro->evento->hora_inicio)->format('g:i A') }} - {{ \Carbon\Carbon::parse($registro->evento->hora_salida)->format('g:i A') }}</strong></span>
        </p>
        
             {{-- 'g:i:A' 'H:i'--}}
        <p class="location">Facultad de Ingeniera de Sistemas y Mecánica Eléctrica</p>
        <div class="qr-code">
            @if (!empty($qrCodeBase64))
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR">
            @else
                <p>No se pudo generar el código QR.</p>
            @endif
        </div>
        <div class="info">
            <h3>Información del Asistente</h3>
            <p><strong>Nombre:</strong>{{ $registro->apellidos }} {{ $registro->nombres }} </p>
            <p><strong>Documento:</strong> {{ $registro->numero_documento }}</p>
            <p><strong>Teléfono:</strong> {{ $registro->numero_celular }}</p>
            <p><strong>Asistente:</strong> {{ $registro->tipo_asistente }}</p>
            <p><strong>Institucion:</strong> {{ $registro->institucion_procedencia }}</p>
        </div>
        <p><em>Este ticket es personal e intransferible. Presente el código QR al ingresar al evento.</em></p>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
