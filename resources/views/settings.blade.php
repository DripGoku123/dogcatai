<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('icon/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}?v=4.0">

    <title>Ustawienia</title>
</head>
<body>
    
    <form action="{{ route('changepass') }}" method="POST">
        <input type="hidden" name="_token" value="{{ $csrf_token }}">
        <input name="auth2" type="hidden" value="{{$auth_u}}">
        <div id="bor">
        @if (session("info") != null)
    <h1>{{session("info")}}</h1>
    @else
    <h1>Ustawienia</h1>
    @endif
        @if ($birth != null)
        <p>Data urodzenia</p>
        <input class="input1" type="date" name="birth" placeholder="Data urodzenia" value="{{$birth}}">
        @else
        <p class="pp">Data urodzenia</p>
        <input class="input2" type="date" name="birth" placeholder="Data urodzenia">
        @endif
        @if ($name != null)
        <input class="input1" type="text" name="name" placeholder="Imię" value="{{$name}}">
        @else
        <input class="input2" type="text" name="name" placeholder="Imię">
        @endif
        @if ($lastname != null)
        <input class="input1" type="text" name="lastname" placeholder="Nazwisko" value="{{$lastname}}">
        @else
        <input class="input2" type="text" name="lastname" placeholder="Nazwisko">
        @endif
        <button type="button" class="pass" id="guzik">Zmień hasło</button>
                <div class="passchange" id="pass">
                    <div class="center">
                        <input class="inp" type="text" name="lastpass" placeholder="Teraźniejsze hasło"><br>
                        <input class="inp" type="text" name="newpass" placeholder="Nowe hasło"><br>
                        <input class="inp" id="inp2" type="hidden" value="Zapisz hasło" name="kierunek">
                    </div>
                </div>
                <div>
                    <input type="submit" class="pass2" value="Zapisz zmiany" name="kierunek">
                </div>
                <div>
                    <input class="pass2" type="submit" value="Powrót" name="kierunek">
                </div>
        </div>
    </form>
    <script src="{{ asset('js/settings.js') }}?v=1.0"></script>
</body>
</html>