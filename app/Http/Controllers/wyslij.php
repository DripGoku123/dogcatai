<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class wyslij extends Controller
{
    function start(Request $request){
        $user = $this->get_user();
        return view('komunikat_wysylanie', ['csrf_token' => csrf_token(), 'auth_u' => $user->encrypt]);
    }
}
