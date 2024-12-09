<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\komunikator;

class wyslany extends Controller
{
    function start(Request $request){
        $user = $this->get_user();
        $cookieValue = $request->cookie('id2');
        $komunikaty = Komunikator::where('id', $cookieValue)->first();
        if($komunikaty && $komunikaty->do == $user->email){
            return view('wyslany', ['csrf_token' => csrf_token(), 'auth_u' => $user->encrypt, 'kom' => $komunikaty]);
        }
        return redirect()->route('wyslane', ['id'=>$user->dynamicurl]);
    }
}
