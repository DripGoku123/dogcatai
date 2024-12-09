<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon/icon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
    <div id="but" class="bortop" onclick="func()"><p style="margin-right:8vmin">Logowanie</p></div>
    <div id="but2" class="bortop2" onclick="func2()"><p style="margin-left:8vmin">Rejestracja</p></div>
    <form action="{{ route('conf') }}" method="POST">
    <input type="hidden" name="_token" value="{{ $csrf_token }}">
        <div class="form1" id="form1">
            <input class="inpt" name="email" type="text" placeholder="Adres email">
            <input class="inpt" name="password" type="password" placeholder="Hasło">
            <input class="inpb" type="submit" value="Zaloguj się" name="kierunek" id="k">
        </div>
    </form>
    <script src="{{ asset('js/login.js') }}"></script>
    <h1 style="position:absolute; left:50%; bottom:1vmin; transform:translateX(-50%)">{{session('info')}}</h1>
</body>
</html>
