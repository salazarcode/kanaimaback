<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Hi {{ $name }},
    <br>
    Gracias por registrate con nosotros. ¡No olvides completar tu registro!
    <br>
    Por favor haz clic en el lick de abajo o cópialo en tu explorador web para verificar tu email
    <br>

    <a href="{{ url('user/verify', $verification_code)}}">Confirmar mi correo electrónico</a>

    <br/>
</div>

</body>
</html>