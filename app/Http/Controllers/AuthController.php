<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function signIn() {
        return view('pages.singin');
    }

    public function signUp() {
         echo 'signup';
    }


    public function index() {
        return view('app');
   }


   public function login(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            dd('Logado');
        } else {
            dd ('Não logado');
        }
   }



}
