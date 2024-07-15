@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <p>会員登録</p>
    </div>
    <form action="{{ route('register') }}" class="form" method="post">
        @csrf
        <div class="form__group">
            <div class="from__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" placeholder="名前" value="{{ old('name') }}" />
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
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
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password_confirmation" placeholder="確認用パスワード" />
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">会員登録</button>
        </div>
        <div class="login__link-group">
            <div class="login__link-title">
                <span class="login__label-itme">アカウントをお持ちの方はこちらから</span>
            </div>
            <div class="login__link">
                <a href="{{ route('login') }}" class="login__button-submit">ログイン</a>
            </div>
        </div>

    </form>
</div>
@endsection
