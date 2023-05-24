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

    public $auth;

    public function __construct()
    {
        $this->auth = (new Firebase)->auth;
    }

    public function checkUser(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
            $user = $signInResult->data();

            // Login berhasil, alihkan pengguna ke halaman dashboard
            if (auth()->check()) {
                return redirect()->route('dashboard'); // Ubah 'dashboard' sesuai dengan nama rute dashboard Anda
            }
        } catch (FailedToSignIn $e) {
            // Email atau kata sandi tidak valid
            Session::flash('error', 'Email atau password tidak sesuai.');
            return redirect()->back();
        } catch (FirebaseException $e) {
            // Tangani error lainnya
            Session::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
        return redirect()->route('dashboard')->with('success', 'Admin Signed In Successfully!');
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Melakukan proses logout

        return redirect()->route('login')->with('message', 'Anda telah berhasil logout.'); // Mengarahkan pengguna kembali ke halaman login
    }

    public function showLogin()
    {
        if (auth()->check()) {
            // Pengguna sudah login, alihkan ke halaman dashboard
            return redirect()->route('dashboard');
        }

        // Pengguna belum login, tampilkan halaman login
        return response()
            ->view('pages.login.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }
}
