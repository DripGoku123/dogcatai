<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Settings extends Controller
{
    function sinfo(Request $request){
        $user = $this->get_user();
        return view('settings', ['csrf_token' => csrf_token(), 'birth' => $user->birthday, 'name' => $user->name, 'lastname' => $user->lastname, 'auth_u' => $user->encrypt]);
    }
}
