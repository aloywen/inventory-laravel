<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth() {
        $data = [
            'title' => 'Login'
        ];

        return view('frontend.login.auth', $data);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/panel/dashboard');
        }

        return back()->with('loginError', 'Email atau password salah!');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function regist() {
        $data = [
            'title' => 'Register'
        ];

        return view('frontend.login.regist', $data);
    }

    public function registPost(Request $request) {
        dd($request->all());
    }

    public function forgotpassword() {
        $data = [
            'title' => 'Forgot Password'
        ];

        return view('frontend..login.forgotpassword', $data);
    }
}
