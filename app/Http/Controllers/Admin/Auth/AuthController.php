<?php

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\User\Auth\AuthController as UserAuthController;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends UserAuthController
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::guard('web-admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->route('welcome');
        }

        return back()
            ->withErrors([
                'email' => 'Неправильный логин или пароль',
            ])
            ->onlyInput('email');
    }
}
