<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunikator-wysłane</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/komunikator.css') }}?v=1">
</head>
<body>
    <form action="{{ route('a') }}" method="POST">
        <input type="hidden" name="_token" value="{{ $csrf_token }}">
        <input type="hidden" name="auth2" value="{{$auth_u}}">
        <div class="main">
                <input type="submit" class="bb" value="Napisz komunikat" name="kierunek">
                <input type="submit" class="bb" value="Zobacz odebrane" name="kierunek">
                <input class="bb" type="submit" value="Powrót" name="kierunek">
        </div>

        <div class="border">
        @foreach($komunikaty as $komunikat)
                <button name="kierunek" value="wyslane_{{ $komunikat->id }}">
                    <div class="komunikatt">
                        <p>{{ $komunikat->do }}</p>
                        <p>{{ $komunikat->kiedy_wyslano }}</p>
                        @if ($komunikat->kiedy_odebrano == null)
                        <p>Komunikat nie został odczytany</p>
                        @else
                        <p>Odebrano: {{ $komunikat->kiedy_wyslano }}</p>
                        @endif
                    </div>
                </button>
            @endforeach
        </div>
    </form>
</body>
</html>