<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InfoZ extends Controller
{
    function change(Request $request){
        $kierunek = $request->input('kierunek');
        $user = $this->get_user();
        if($kierunek == "Zapisz zmiany"){
            $request->validate([
                'birth' => 'nullable|date',
            ]);
            $birth = $request->input("birth");
            $name = $request->input("name");
            $lastname = $request->input("lastname");
            $user->birthday = $birth;
            $user->name = $name;
            $user->lastname = $lastname;
            $user->save();
            return redirect()->route('settings',['id'=>$user->dynamicurl])->with('info', "Pomyślnie zapisano ustawienia");
        }
        elseif($kierunek == "Zapisz hasło"){
            $lastp = $request->input('lastpass');
            if (Hash::check($lastp, $user->password)){
                $validator = Validator::make($request->all(), [
                    'newpass' => 'required|min:6|regex:/[A-Za-z]/|regex:/[0-9]/|regex:/[\W_]/',
                ]);
                if ($validator->fails()) {
                    // Własna odpowiedź
                    return response()->json([
                        'status' => 'info',
                        'message' => 'Nowe hasło jest za krótkie',
                        'errors' => $validator->errors()
                    ], 422);
                }
                $newp = $request->input('newpass');
                $user->password = $newp;
                $user->save();
                return redirect()->route('settings',['id'=>$user->dynamicurl])->with('info', "Pomyślnie zmieniono hasło");
            }
            else{
                return redirect()->route('settings',['id'=>$user->dynamicurl])->with('info', "Stare hasło się nie zgadza");
            }
        }
        elseif($kierunek == "Powrót"){
            return redirect()->route('user_site',['id'=>$user->dynamicurl]);
        }
        else{
            return redirect()->route('logowanie')->with('info', "Wystąpił błąd");
        }
    }
}
