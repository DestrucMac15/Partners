<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Restaura tu contrseña!</h1>
        <p>En el siguiente enlase podras restaurar tu contraseña</p>
        <ul>
            <li>Enlaces: <a href="http://pastillasnuevas.store/partners/login/reset/<?= $lead;?>">Cambiar contraseña</a></li>
        </ul>
        <p>Si usted no realizo el cambio de contraseña, no prestar atencion al correo</p>
    </div>
</body>
</html>