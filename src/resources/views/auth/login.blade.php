@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-form__content">
    <div class="login-form__heading">
        <p>ログイン</p>
    </div>
    <form action="{{ route('login') }}" class="form" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
        </div>
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="パスワード" />
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
        <div class="register__link-group">
            <div class="register__link-title">
                <span class="register__label-itme">アカウントをお持ちでない方はこちらから</span>
            </div>
            <div class="register__link">
                <a href="{{ route('register') }}" class="register__button-submit">会員登録</a>
            </div>
        </div>

    </form>
</div>
@endsection
