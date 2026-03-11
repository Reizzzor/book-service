<?php

namespace App\Http\Controllers\User\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->route('welcome');
        }

        return back()
            ->withErrors([
                'email' => 'Неправильный логин или пароль',
            ])
            ->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }
}
