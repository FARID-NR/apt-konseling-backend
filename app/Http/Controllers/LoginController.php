<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Firebase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Auth\SignIn\FailedToSignIn;
use Kreait\Firebase\Exception\FirebaseException;
use \App\Http\Middleware\Authenticate;



class LoginController extends Controller
{
    public function login()
    {
        return view('pages.login.login');
    }

    public function login_action(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/dashboard');
        }
        return back()->with('pesan-danger', 'Username atau Password anda salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
