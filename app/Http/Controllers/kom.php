<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komunikator;

class kom extends Controller
{
    function start(Request $request){
        $user = $this->get_user();
        $komunikaty = Komunikator::where('do', $user->email)->orderBy('kiedy_wyslano', 'desc')->get();
        return view('kom', ['csrf_token' => csrf_token(), 'auth_u' => $user->encrypt, 'komunikaty' => $komunikaty]);
    }
}
