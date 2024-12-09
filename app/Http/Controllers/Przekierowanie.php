<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Exception;
class Przekierowanie extends Controller
{
    function przekierowanie(Request $request){
        $kierunek = $request->input('kierunek');
        $user = $this->get_user();
        if ($kierunek == 'settings'){
            return redirect()->route('settings', ['id'=>$user->dynamicurl]);
        }
        elseif($kierunek == 'ai'){
            return redirect()->route('ai', ['id'=>$user->dynamicurl]);
        }
        elseif($kierunek == 'kom' || $kierunek == 'Zobacz odebrane'){
            return redirect()->route('komunikator', ['id'=>$user->dynamicurl]);
        }
        elseif($kierunek == "Napisz komunikat"){
            return redirect()->route('wyslij',['id'=>$user->dynamicurl]);
        }
        elseif($kierunek == "Zobacz wysłane"){
            return redirect()->route('wyslane',['id'=>$user->dynamicurl]);
        }
        elseif($kierunek == "rozpoznaj"){
            

            // Przechowywanie obrazu
            $path = $request->file('image')->store('images', 'public');
            $filePath = storage_path("app/public/{$path}");
    
            // Wysyłanie zapytania POST do zewnętrznego API
            try {
                $response = Http::attach(
                    'file', // Klucz dla pliku
                fopen($filePath, 'r'), // Otwieramy plik w trybie odczytu
                basename($filePath)
                )->post('http://127.0.0.2:5001/aii'); // Właściwy URL API
        
                // Obsługa odpowiedzi
                $data = $response->json(); // Jeśli odpowiedź jest w formacie JSON
                    
                return redirect()->route('ai',['id'=>$user->dynamicurl])->with('data', $data['message']);
            }
            catch(Exception $e){
                return redirect()->route('ai',['id'=>$user->dynamicurl])->with('data', "Wystąpił błąd :(");
            }
        }
        elseif($kierunek == "zad"){
            return redirect()->route('wyslane',['id'=>$user->dynamicurl]);
        }
        elseif($kierunek == "Powrót"){
            return redirect()->route('user_site',['id'=>$user->dynamicurl]);
        }
        elseif(str_starts_with($kierunek, 'wyslane_')){
            $id2 = explode('_', $kierunek)[1];
            return redirect()->route('wyslany',['id'=>$user->dynamicurl])->withCookie(cookie('id2', $id2, 60));
        }
        elseif (str_starts_with($kierunek, 'tresc_')) {
            $id = explode('_', $kierunek)[1];
            return redirect()->route('komunikat',['id'=>$user->dynamicurl])->withCookie(cookie('id', $id, 60));
        }
        else{
            $cookie = Cookie::make('protect', '', -1, '/');
            $cookie2 = Cookie::make('protectu','', -1, '/'); 
            $user->cookiesession = null;
            $user->dynamicurl = null;
            $user->encrypt = null;
            $user->save();
            return redirect()->route('logowanie')->with('info', "Wylogowano")->cookie($cookie)->cookie($cookie2);                   
        }
        
    }
}
