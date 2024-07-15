<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AuthenticatedSessionController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $loginData = $request->only('email', 'password');
        $user = User::where('email', $loginData['email'])->first();
        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();

            if (!$user->hasVerifiedEmail()) {
                $user->sendEmailVerificationNotification();
                $request->session()->flash('massege', 'ご登録いただいたメールアドレスに認証リンクを送信しましたので、ご確認ください。');
            }
            return redirect()->route('verification.notice');
        } else {
            return redirect('/login')
                ->withErrors(['password' => 'パスワードが違います'])
                ->withInput($request->only('email'));
        }
    }
}
