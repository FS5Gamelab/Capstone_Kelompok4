<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('login.register');
    }


    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Silakan isi email',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Silakan isi password',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin');
        } else {
            return redirect()->back()->withErrors(['email' => 'Login gagal. Periksa kembali email dan password Anda'])->withInput();
        }
    }
}
