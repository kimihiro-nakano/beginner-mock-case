@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verifyEmail.css') }}">
@endsection

@section('content')
<div class="verify__content">
    <div class="verify__heading">
        <p>メール認証</p>
    </div>
    <div class="verify__group">
        <div class="verify__group-content">
            @if (session('message'))
                <div class="alert__success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            @unless (session('message'))
                <p>メールアドレスに認証リンクを送信します。下記の"認証リンクを送信"をクリックしてください。</p>
            @endunless

            <form action="{{ route('verification.send') }}" class="verify" method="post">
                @csrf
                <div class="verify__button">
                    <button class="verify__button-submit" type="submit">認証リンクを送信</button>
                </div>
                <div class="login__link-group">
                    <div class="login__link">
                        <a href="{{ route('login') }}" class="login__button-submit">ログイン画面に戻る</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
