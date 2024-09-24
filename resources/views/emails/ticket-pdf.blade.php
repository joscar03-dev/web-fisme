{{-- <!DOCTYPE html>
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

</html> --}}


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Evento Profesional</title>
    <style>
        @media print {
            body {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 0;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .ticket-container {
            width: 100%;
            max-width: 210mm;
            padding: 20px;
            box-sizing: border-box;
        }

        .ticket {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .ticket-header {
            background-color: #133E6B;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .ticket-qr {
            text-align: center;
            padding: 30px 0;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .ticket-qr img {
            width: 200px;
            height: 200px;
        }

        .ticket-body {
            padding: 20px;
        }

        .ticket-info {
            margin-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 10px;
        }

        .ticket-info:last-child {
            border-bottom: none;
        }

        .ticket-label {
            font-weight: bold;
            color: #133E6B;
            margin-bottom: 5px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .ticket-value {
            font-size: 16px;
            color: #495057;
        }

        .ticket-footer {
            background-color: #133E6B;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            font-weight: bold;
        }

        @media (max-width: 480px) {
            .ticket-container {
                padding: 10px;
            }

            .ticket {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="ticket-container">
        <div class="ticket">
            <div class="ticket-header">
                Ticket de Evento
            </div>
            <div class="ticket-qr">
                @if (!empty($qrCodeBase64))
                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR">
                @else
                    <p>No se pudo generar el código QR.</p>
                @endif
            </div>
            <div class="ticket-body">
                <div class="ticket-info">
                    <div class="ticket-label">Nombre del Evento:</div>
                    <div class="ticket-value">{{ $registro->evento->nombre_evento }}</div>
                </div>
                <div class="ticket-info">
                    <div class="ticket-label">Fecha</div>
                    <div class="ticket-value">{{ $registro->evento->fecha_inicio }}</div>
                </div>
                <div class="ticket-info">
                    <div class="ticket-label">Documento</div>
                    <div class="ticket-value">{{ $registro->numero_documento }}</div>
                </div>
                <div class="ticket-info">
                    <div class="ticket-label">Nombre</div>
                    <div class="ticket-value">{{ $registro->nombres }} {{ $registro->apellidos }}</div>
                </div>
                <div class="ticket-info">
                    <div class="ticket-label">Email</div>
                    <div class="ticket-value">{{ $registro->email }}</div>
                </div>
            </div>
            <div class="ticket-footer">
                #A1B2C3 - Válido hasta el día del evento
            </div>
        </div>
    </div>
</body>

</html>
