<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;

class AuthController extends Controller
{
    function index ()
    {
       return view('login.login');
    }
    function login (Request $request)
    {
        $request->validate([
            'email'=> 'required',
            'password'=> 'required'
        ],[
            'email.required'=>'Silakan isi email',
            'password.required'=>'Silakan isi password',
        ]);

        $checklogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($checklogin))
            echo ('anjaii sukses');
        else{
            return redirect('')->withErrors('Login gagal. Periksa kembali email dan password Anda')->withInput();
        }
    }
}