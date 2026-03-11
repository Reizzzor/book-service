<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(ProfileRequest $request)
    {
        app(UserService::class)->create($request->validated());

        return redirect()->route('auth.index');
    }
}
