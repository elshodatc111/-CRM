<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function profile(){
        return view('auth.profile');
    }

    public function passwordUpdate(UpdatePasswordRequest $request){
        $validated = $request->validated();
        $user = $request->user();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);
        return back()->with('status', 'password-updated')->with('success', __('auth.password_update'));
    }

}
