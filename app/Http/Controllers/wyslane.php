<?php

namespace App\Http\Controllers;
use App\Models\Komunikator;
use Illuminate\Http\Request;

class wyslane extends Controller
{
    function start(Request $request){
        $user = $this->get_user();
        $komunikaty = Komunikator::where('od', $user->email)->orderBy('kiedy_wyslano', 'desc')->get();
        return view('wyslane', ['csrf_token' => csrf_token(), 'auth_u' => $user->encrypt, 'komunikaty' => $komunikaty]);
    }
}
