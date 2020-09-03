<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticationController extends Controller
{
    public function index()
    {
        return Inertia::render('auth/Login');
    }

    public function login(Request $request)
    {
        //
    }

    public function register(Request $request)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
    }
}
