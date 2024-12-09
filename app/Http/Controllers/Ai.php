<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ai extends Controller
{
    function start(Request $request){
        $user = $this->get_user();
        return view('ai', ['csrf_token' => csrf_token(), 'auth_u' => $user->encrypt, 'name' => $user->name]);
    }
}
