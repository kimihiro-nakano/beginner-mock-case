<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function showRegister()
    {
        $users = User::all();

        return view('auth.register', compact('users'));
    }

    public function register(RegisterRequest $request)
    {
        $registerData = $request->all();
        $registerData['password'] = Hash::make($registerData['password']);
        User::create($registerData);

        return redirect('/login');
    }
}
