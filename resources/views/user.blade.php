<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Użytkownik</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/user_site.css') }}?v=2.2">
</head>
    @if ($powiad > 0)
    <input type="hidden" value="Nowe wiadomości: {{$powiad}}" id="powiad">
    @else
    <input type="hidden" value="Brak nowych wiadomości :(" id="powiad">
    @endif
    <div class="bordertop">

    @if ($name == null)
                Witaj!
    @else
    Witaj {{$name}}!
    @endif
    </div>
    <form action="{{ route('a') }}" method="POST">
        <input type="hidden" name="_token" value="{{ $csrf_token }}">
        <input type="hidden" name="auth2" value="{{$auth_u}}">
        <div class="borderleft">
            <div class="object2"></div>
            @if ($powiad > 0)
            <button type="button" id="kom"><div class="objecta"><img class="imgob" src="{{ asset('icon/message.png') }}"> <div class="b"></div></div></button>
            @else
            <button type="button" id="kom"><div class="object"><img class="imgob" src="{{ asset('icon/message.png') }}"></div></button>
            @endif
            <button type="button" value="ai" name="kierunek" id="ai"><div class="object"><img class="imgob" src="{{ asset('icon/aiikon.png') }}"></div></button>
            @if ($powiadz > 0)
            <button type="button" id="zad"><div class="objecta"><img class="imgob" src="{{ asset('icon/zadania.png') }}"> <div class="b"></div></div></button>
            @else
            <button type="button" id="zad"><div class="object"><img class="imgob" src="{{ asset('icon/zadania.png') }}"></div></button>
            @endif
        </div>


        <button type="submit" name="kierunek" value="settings">
            <div class="setting"><img src="{{ asset('icon/setting.png') }}"></div>
            @if ($count > 0)
                <div class="infor"><b>{{$count}}</b></div>
            @endif
        </button>
        <button type="submit" name="kierunek" value="logout">
            <div class="logout"><div id="textm">Wyloguj</div> <img src="{{ asset('icon/wyloguj.png') }}"></div>
        </button>
        <div class="coolobject" id="i">
            <p class="main">Gdzie chcesz dziś się wybrać?</p>
            <p>(klikaj przyciski po lewej)</p>
        </div>
    </form>
    <script src="{{ asset('js/user_site.js') }}?v3"></script>
</body>
</html>