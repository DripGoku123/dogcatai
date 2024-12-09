<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wysłany-komunikat</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/komunikat.css') }}?v=5">
</head>
<body>
<div id="thing">

    <div id="borderr">
        <div class="border2">
            <div>
            <p>Komunikat wysłany do {{ $kom->do }}</p>
            <p class="h">Wysłano: {{ $kom->kiedy_wyslano }}</p>
            </div>
        </div><br>
        <div id="thing2">
            <textarea  readonly name="tresc" cols="80" rows="10" maxlength="3000" required placeholder="{{ $kom->wiadomosc }}"></textarea>
        </div><br>
        <div id="thing2">
            <form action="{{ route('a_k') }}" method="POST">
                <input type="hidden" name="_token" value="{{ $csrf_token }}">
                <input type="hidden" name="auth2" value="{{$auth_u}}">
                <input type="submit" class="inp3" name="kierunek" value="Powrót">
            </form>
            <br>
        </div>
    </div>
</div>
</body>
</html>