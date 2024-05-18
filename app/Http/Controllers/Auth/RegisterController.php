<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CinemaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm(){
        return view('auth/auth', ['isLogin' => false]);
    }
    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',

        ]);
        // Перевірка, чи існує вказана електронна пошта в базі даних
        $existingUser = CinemaUser::where('email', $validatedData['email'])->first();
        if($existingUser){
            return redirect()->back()->withErrors(['email' => 'Ця електронна пошта вже існує.'])->withInput($request->except('email'));
        }
        // Створення нового користувача
        $user = CinemaUser::create([
            'name' => $validatedData['name'],
            'birth_day' => '2024-05-08',
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
             // Включення дати народження
        ]);
        Auth::login($user);
        return redirect()->route('main')->with('success', 'Ви успішно зареєструвалися!');

    }

}
