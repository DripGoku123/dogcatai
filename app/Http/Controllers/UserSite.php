<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class UserSite extends Controller
{
    //funkcja od uzyskiwania danych
    public function info(Request $request, $id)
    {
        // Uzyskujemy użytkownika (na podstawie sesji, ID lub innych danych)
        $user = $this->get_user();
        $count = 0;
        
        // Liczymy puste dane
        foreach ([$user->name, $user->lastname, $user->birthday] as $thing){
            if ($thing == null){
                $count++;
            }
        }
        $count2 = $user->notificationsk;
        $count3 = $user->notificationsp;

        // Przekazywanie wartości do widoku
        return view('user', ['count' => $count,'csrf_token' => csrf_token(), 'auth_u' => $user->encrypt, 'name' => $user->name, 'powiad' => $count2, 'powiadz' => $count3]);
    }
}
