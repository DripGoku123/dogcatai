<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Napisz-komunikat</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/wyslij.css') }}?v=5">
</head>
<body>
    <form action="{{ route('a_k') }}" method="POST">
        <input type="hidden" name="_token" value="{{ $csrf_token }}">
        <input type="hidden" name="auth2" value="{{$auth_u}}">
            <div id="thing">
                <div id="borderr">
                    <div class="border2">
                        <div>
                            <p><input type="text" name="do_kogo" placeholder="Do kogo?" required></p>
                        </div>
                    </div><br>
                    <div id="thing2">
                        <textarea name="wiadomosc" cols="80" rows="10" maxlength="3000" required placeholder='{{session('info', 'Napisz wiadomość...')}}'></textarea>
                    </div><br>
                <div id="thing2">
                    <input type="submit" class="inp3" name="kierunek" value="Wyślij" required><br>
                    <input type="submit" class="inp3" name="kierunek" value="Powrót" id="powrot">
                </div>
                </div>
            </div>
    </form>
    <script src="{{ asset('js/wyslij.js') }}?v=1.0"></script>
</body>
</html>