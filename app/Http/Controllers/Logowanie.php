<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Logowanie extends Controller
{
    public function login(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/[A-Za-z]/|regex:/[0-9]/|regex:/[\W_]/',
            'kierunek' => 'required'
        ]);

        // Odbieranie danych z formularza
        $email = $request->input('email');
        $password = $request->input('password');
        $kierunek = $request->input(key: 'kierunek');
        $info = "Dane konto nie istnieje";
        // Autoryzacja, rejestracja
        $user = User::where('email', $email)->first();     
        if ($user){
            if (RateLimiter::tooManyAttempts($email, 5)) {
                return redirect()->route('logowanie')->with('info', 'Za dużo nieudanych prób logowania. Spróbuj ponownie później.');
            }
            elseif ($kierunek == "Zaloguj się"){
                if (Hash::check($password, $user->password)){
                    $randomString = Str::random(32); // Losowy ciąg
                    $uniqueToken = hash('sha256', $user->id . now()->timestamp . $randomString);
                    $user->cookiesession = $uniqueToken;
                    $randomString2 = Str::random(10);
                    $dynamicurl = hash('sha256', $user->id . $randomString2);
                    $user->dynamicurl = $dynamicurl;
                    $payload = [
                        'iss' => $user->email,  // Issuer
                        'sub' => $user->id,  // Subiekt 
                        'iat' => time(),  // Czas wystawienia tokenu
                        'exp' => time() + 14400  // Czas wygaśnięcia (4godziny)
                    ];
                    $jwt = JWT::encode($payload, env('SECRET1'), 'HS256'); //sekretny klucz (lepiej w zmiennej systemowej)
                    $payload2 = [
                        'iss' => $uniqueToken,
                        'sub' => $user->id,
                        'iat' => time(),
                        'exp' => time() + 14400 
                    ];
                    //szyfrowanie danych
                    $jwt2 = JWT::encode($payload2, env('SECRET2'), 'HS256'); //sekretny klucz (lepiej w zmiennej systemowej)
                    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
                    $iv2 = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
                    $encrypted_jwt = openssl_encrypt($jwt, 'aes-256-cbc', env('KLUCZ1_S'), 0, $iv);
                    $encrypted_jwt2 = openssl_encrypt($jwt2, 'aes-256-cbc', env('KLUCZ2_S'), 0, $iv2);
                    $encrypted_jwt = base64_encode($encrypted_jwt . '::' . base64_encode($iv));
                    $encrypted_jwt2 = base64_encode($encrypted_jwt2 . '::' . base64_encode($iv2));
                    //ciasteczka
                    $user->encrypt = $encrypted_jwt2;
                    $user->save();
                    $cookie = Cookie::make('protect', $uniqueToken, 240, '/', null, false/* ustaw na true gdy używamy https */, true, false, 'Lax');
                    $cookie2 = Cookie::make('protectu',$encrypted_jwt, 240, '/', null, false/* ustaw na true gdy używamy https */, true, false, 'Lax');                    
                    return redirect()->route('user_site',['id'=>$user->dynamicurl])->cookie($cookie)->cookie(cookie: $cookie2);
                }
                else{
                    RateLimiter::hit($email);
                    Log::info('Hasło wprowadzone przez użytkownika: ' . $password);
                    Log::info('Hash zapisany w bazie: ' . $user->password);
                    Log::info('Wynik porównania: ' . (Hash::check($password, $user->password) ? 'true' : 'false'));
                    return redirect()->route('logowanie')->with('info', "Niepoprawny login lub hasło");
                }
            }
            else{
                $info = "Dany użytkownik już istnieje";
            }
        }   
        // Rejestracja
        elseif ($kierunek == "Zarejestruj się") {
            DB::transaction(function() use ($email, $password) { 
                // transaction nie zapisuje danych gdy wystąpi błąd
                User::create([
                    'email' => $email,
                    'password' => $password,
                    'cookiesession' => Str::random(32),
                    'notificationsk' => 0,
                    'notificationsp' => 0

                ]);
            });
            $info = "Konto zostało zarajestrowane";
        }
        // Przykładowe działanie po otrzymaniu danych
        return redirect()->route(route: 'logowanie')->with('info', $info);

    }
}
?>