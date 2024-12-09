<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline';">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('icon/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/ai.css') }}">

    <title>Ai</title>
</head>
<body>
    <div class="borc">
    <form action="{{ route('a') }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ $csrf_token }}">
    <input type="hidden" name="auth2" value="{{$auth_u}}">
        <div class="file-upload">
            <label for="file-input" class="custom-file-label">
                <span>Wybierz plik</span>
            </label>
            <input type="file" name="image" id="file-input" accept="image/*">
            <div class="image-preview">
                <img id="preview-image" src="" alt="Podgląd obrazu" style="display:none">
            </div>
            <button type="submit" name="kierunek" value="rozpoznaj" class="inp3">Wyślij</button>
        </div>
    </form>
    <p>{{ session('data','') }}</p>
    </div>
    <script src="{{ asset('js/ai.js') }}"></script>

</body>
</html>