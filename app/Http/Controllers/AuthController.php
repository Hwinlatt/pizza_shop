<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }
    public function registerPage()
    {
        return view('register');
    }

    // after login route
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
        if (Auth::user()->role == 'user') {
            return redirect()->route('user#home');
        }
    }

}
