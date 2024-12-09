<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use App\Models\User;
use Firebase\JWT\Key;
use Exception;

class PostCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // Middleware stworzony do dodatkowego zabezpieczenia formularzy
    public function handle(Request $request, Closure $next): Response
    {
        
        try {
            $auth2 = $request->input('auth2');
            if (!$auth2){
                return redirect()->route('logowanie')->with("info","Błąd sesji 1");
            }
            list($encrypted_jwt, $encoded_iv) = explode('::', base64_decode($auth2));
            $iv = base64_decode($encoded_iv);
            $decrypted_jwt = openssl_decrypt($encrypted_jwt, 'aes-256-cbc', env('KLUCZ2_S'), 0, $iv);

            $key = env('SECRET2');
            $key = new Key($key, 'HS256');
            $decoded = JWT::decode($decrypted_jwt, $key);
            $user = User::where('id', (int)($decoded->sub))->first();
            if (!$user->cookiesession || !$user->encrypt || !$user->dynamicurl){
                return redirect()->route('logowanie')->with("info","Wylogowano");
            }
            if ($user->cookiesession == $decoded->iss){
                return $next($request);
            }
            return redirect()->route('logowanie')->with("info","Błąd sesji 2");
        }
        catch (Exception $exception) {
            // Obsługuje wyjątek i zwraca odpowiedź w przypadku błędu
            return redirect()->route('logowanie')->with("info", $exception->getMessage());
        }
    }
}
