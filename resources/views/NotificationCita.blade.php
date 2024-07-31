<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificación de Cita Médica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333333;
        }

        .content {
            line-height: 1.6;
            color: #666666;
        }

        .content p {
            margin: 0;
        }

        .content strong {
            color: #333333;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Notificación de Cita Médica</h1>
        </div>
        <div class="content">
            <p>Hola, {{ $emailData['user'] }},</p>
            <p>Tu cita médica ha sido confirmada con el <strong>Dr.</strong> <span>{{ $emailData['doctor'] }}</span>.
            </p>
            <p><strong>Hora:</strong> <span>{{ $emailData['hour'] }}</span></p>
        </div>
        <div class="footer">
            <p>Gracias por confiar en nuestros servicios.</p>
        </div>
    </div>

</body>

</html>
