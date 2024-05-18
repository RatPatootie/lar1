<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CinemaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    protected function saveIntendedUrl(Request $request)
    {
        if (!$request->is('login') && !$request->is('logout') && !$request->is('register') && !$request->is('password/*')) {
            session()->put('url.intended', url()->previous());
        }
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (session()->has('url.intended')) {
            return session('url.intended');
        }

        return route('main');
    }

    public function showLoginForm()
    {
        $this->saveIntendedUrl(request());
        return view('auth.auth', ['isLogin' => true]);
    }

    public function login(Request $request)
    {
        $existingUser = CinemaUser::where('email', $request['email'])->first();
        if(!$existingUser){
            return redirect()->back()->withErrors(['email' => 'Ця електронна пошта не існує.'])->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication was successful
            return redirect($this->redirectTo()); // Redirect to the intended page after login
        }

        // If authentication fails, redirect back to the login form with an error message
        return redirect()->back()->withErrors(['password' => 'Invalid password'])->withInput();
    }




    public function logout()
    {
        Auth::logout();
        return redirect()->back(); // Redirect to your desired page after logout
    }}

