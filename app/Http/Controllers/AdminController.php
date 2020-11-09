<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function login() {
        if (Auth::check()) {
            return redirect()->to('administrator');
        }
        return view('login');
    }

    function postLogin(Request $request) {
        // dd($request->has('remember_me'));
        $remember = $request->has('remember_me') ? true : false;
        if (Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ], $remember)) {
            return redirect()->to('administrator');
        }
    }
}
