<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Actualización de contraseña</title>
    <style>
        /* Estilos CSS para el correo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            margin-bottom: 20px;
        }
        p {
            color: #555555;
            margin-bottom: 10px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Actualización de contraseña</h1>
        
        <p>Hola, {{$userName}}</p>

        <p>Has solicitado actualizar tu contraseña. Haz clic en el siguiente enlace para establecer una nueva contraseña:</p>

        <p><a href="{{$linkCallback}}" class="button">Actualizar contraseña</a></p>

        <p>Si no solicitaste la actualización de contraseña, no es necesario que realices ninguna acción.</p>

        <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>

        <p>Saludos,</p>
        <p>El equipo de nuestra plataforma</p>
    </div>
</body>
</html>
