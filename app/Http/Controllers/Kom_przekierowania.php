<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\komunikator;

class Kom_przekierowania extends Controller
{
    function przekierowanie(Request $request){
        $kierunek = $request->input('kierunek');
        $user = $this->get_user();
        if($kierunek == 'Wyślij'){
            $email = $request->input('do_kogo');
            $wiadomosc = $request->input('wiadomosc');
            if (strlen($wiadomosc) > 65535) {
                return redirect()->route('wyslij',['id'=>$user->dynamicurl])->with('info', 'Wiadomość jest za długa');
            }
            $userr = User::where('email', $email)->first();
            if (!$userr){
                return redirect()->route('wyslij',['id'=>$user->dynamicurl])->with('info', 'Dany odbiorca nie istnieje');
            }
            komunikator::create([
                'od' => $user->email,
                'do' => $email,
                'wiadomosc' => $wiadomosc,
                'kiedy_wyslano' => date('Y-m-d H:i:s'),
                'kiedy_odebrano' => null
            ]);
            $userr->notificationsk = $userr->notificationsk + 1;
            $userr->save();
            return redirect()->route('wyslij',['id'=>$user->dynamicurl])->with('info', 'Wiadomość została pomyślnie wysłana');

        }
        elseif($kierunek == "Powrót"){
            return redirect()->route('komunikator',['id'=>$user->dynamicurl]);
        }
    }
}