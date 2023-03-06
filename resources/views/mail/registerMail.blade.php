
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperação de senha</title>
</head>
<body>
    <div>
        <span>Olá {{ $emailData['nome'] }}, você fez a solicitação de alteração de senha.</span>
        <span><a href="{{ route('newPass', $emailData['token']) }}">Clique aqui</a> ou copie o link abaixo para fazer a alteração da senha!</span>
        <br><br><br>
        <span>{!! route('newPass', $emailData['token']) !!}</span>
    </div>
</body>
</html>