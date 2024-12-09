<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\komunikator;

class komunikat extends Controller
{
    function start(Request $request){
        $user = $this->get_user();
        $cookieValue = $request->cookie('id');
        $komunikaty = Komunikator::where('id', $cookieValue)->first();
        if($komunikaty && $komunikaty->do == $user->email){
            if ($komunikaty->kiedy_odebrano == null){
                $komunikaty->kiedy_odebrano =  date('Y-m-d H:i:s');
                $komunikaty->save();
                $user->notificationsk = $user->notificationsk-1;
                $user->save();
            }
            return view('komunikat', ['csrf_token' => csrf_token(), 'auth_u' => $user->encrypt, 'kom' => $komunikaty]);
        }
        return redirect()->route('komunikator', ['id'=>$user->dynamicurl]);
    }
}
