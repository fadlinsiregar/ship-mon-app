<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        
    }

    public function index() {
        return view('dashboard.index');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function login(Request $request) {
        
    }

    public function register(Request $request) {
        return true;
    }

    public function logout() {
        return true;
    }
}
