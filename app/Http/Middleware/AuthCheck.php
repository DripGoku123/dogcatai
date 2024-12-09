<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Firebase\JWT\Key;
use Exception;

class AuthCheck
{

    //middleware stworzony aby sprawdzać czy użytkownik jest zalogowany przez ciasteczka
    function handle(Request $request, Closure $next){
        try{
            //uzyskiwanie ciasteczek i sprawdzenie czy istnieją
            $authinfo = Cookie::get("protect");
            $jwtCookie = Cookie::get('protectu');
            if (!$jwtCookie or !$authinfo){
                return redirect()->route('logowanie')->with("info", "Błąd sesji lub użytkownik jest wylogowany");
            }
            //przygotowanie danych i rozszyfrowanie
            list($encrypted_jwt, $encoded_iv) = explode('::', base64_decode($jwtCookie));
            $iv = base64_decode($encoded_iv);
            $decrypted_jwt = openssl_decrypt($encrypted_jwt, 'aes-256-cbc', env('KLUCZ1_S'), 0, $iv);
            $key = env('SECRET1'); //Przyszłościowo należy używać zmiennej środowiskowej
            $key = new Key($key, 'HS256');
            $decoded = JWT::decode($decrypted_jwt, $key);
            //uzyskiwanie użytkownika
            $user = User::where('id', (int)($decoded->sub))->where('email', $decoded->iss)->first();     
            if (!$user) {
                return redirect()->route('logowanie')->with("info", "Błąd sesji");
            }
            if (!$user->cookiesession || !$user->encrypt || !$user->dynamicurl){
                return redirect()->route('logowanie')->with("info","Błąd sesji lub użytkownik jest wylogowany");
            }
            //sprawdzenie danych
            if($user->cookiesession == $authinfo){
                $response =  $next($request);
                $response->headers->set('X-Frame-Options', 'DENY');
                $response->headers->set('X-Content-Type-Options', 'nosniff');
                $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self'");
                $response->headers->set('id' , $user->dynamicurl);
                return $response;
            }
            return redirect()->route('logowanie')->with("info", "Błąd sesji");
        }
        catch (Exception $exception) {
            // Obsługuje wyjątek i zwraca odpowiedź w przypadku błędu
            return redirect()->route('logowanie')->with("info", "Błąd sesji");
        }
    }
}
