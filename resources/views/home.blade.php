<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link rel="icon" type="image/x-icon" href="{{ asset('icon/icon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
    <div class="welcomet">Witaj na witrynie!</div>
    <div class="lowerbor">
        <p>Chcesz sprawdzić czy na zdjęciu jest kot czy pies?</p>
        <p>A może chcesz popisać z przyjaciółmi?</p>
        <button class="bottomt" onclick="window.location.href='/login'">
            Zaloguj się!
        </button>
    </div>
    <div class="bar">
        <img src="{{ asset('icon/discord.png') }}"><img src="{{ asset('icon/facebook.png') }}">
    </div>
</body>
</html>
