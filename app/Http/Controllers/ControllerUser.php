<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class ControllerUser extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $r)
    {
        //return bcrypt('Boom');
        if (Auth::attempt(['NRP' => $r->NRP, 'password' => $r->pass])) {
            //return view('coba');
            //return "benar";

            return redirect('/');
        }else{
            return redirect('/')->with('alert','Kombinasi NRP/NIP dan password salah!');
        }
    }

    public function logout(Request $r)
    {
        Auth::logout();
        return redirect('/');
    }
}
