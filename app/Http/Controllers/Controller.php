<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Support\Str;
use Firebase\JWT\Key;
class Controller extends BaseController
{
    function get_user(){
        $jwtCookie = Cookie::get('protectu');
        if (!$jwtCookie){
            return redirect()->route('logowanie');
        }
        //przygotowanie danych i ich odszyfrowywanie
        list($encrypted_jwt, $encoded_iv) = explode('::', base64_decode($jwtCookie));
        $iv = base64_decode($encoded_iv);
        $decrypted_jwt = openssl_decrypt($encrypted_jwt, 'aes-256-cbc', "kluczszyfrowania1", 0, $iv);

        $key = env('SECRET1');
        $key = new Key($key, 'HS256');
        $decoded = JWT::decode($decrypted_jwt, $key);
        //uzyskiwanie użytkownika, liczenie null w informacjach o użytkowniku
        $user = User::where('id', (int)($decoded->sub))->first();
        if (!$user){
            return redirect()->route('logowanie')->with("info", "Błąd sesji");
        }
        return $user;
    }
}
?>