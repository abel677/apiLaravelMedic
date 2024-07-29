<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de cuenta</title>
</head>

<body>

    <h1>Confirmiació de cuenta</h1>
    <h6>
        Hola, {{ $mailData['usuario'] }}
    </h6>
    <p>
        Para confirmar tu cuenta has click en el siguiente enlace

        <strong>

            {{ $mailData['link'] }}

        </strong>


    </p>

</body>

</html>
