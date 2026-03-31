<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller{
    
    public function login(){
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request){
        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status === 'false') {
                Auth::logout();
                return back()->withErrors(['phone' => __('auth.user_blocked'),])->withInput();
            }
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
        return back()->withErrors(['phone' => __('auth.error'),])->withInput();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
