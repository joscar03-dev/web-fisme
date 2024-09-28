<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje de contacto</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/email-framework/0.1.0/email-framework.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
        }
        .header {
            background-color: #1e3a8a;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f4f4f4;
            color: #666666;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nuevo mensaje de contacto</h1>
        </div>
        <div class="content">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <h2>Detalles del mensaje:</h2>
                        <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Mensaje:</h2>
                        <p>{{ $data['message'] }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Este mensaje fue enviado desde el formulario de contacto de su sitio web.</p>
        </div>
    </div>
</body>
</html>