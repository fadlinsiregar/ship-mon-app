<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('web');
    }

    public function showLogin() {
        return view('auth.login', ['title' => 'Masuk ke ShipMon']);
    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return redirect(route('auth.login'))->with('message', 'Anda telah berhasil logout!');
    }
}
