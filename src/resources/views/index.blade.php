@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
<nav class="header__menu">
    <ul class="header__menu-list">
        <li class="header__menu-item"><a href="/" class="header__menu-link">ホーム</a></li>
        <li class="header__menu-item"><a href="/attendance" class="header__menu-link">日付一覧</a></li>
        <li class="header__menu-item"><a href="/user_list" class="header__menu-link">ユーザーページ</a></li>
        <li class="header__menu-item">
            @if (Auth::check())
            <form action=" {{ route('logout')}}" method="post" class="logout-from">
                @csrf
                <input type="submit" class="header__menu-link button-as-link" value="ログアウト">
            </form>
            @endif
        </li>
    </ul>
</nav>
@endsection

@section('content')
<div class="timestamp__content">
    <div class="timestamp__title">
        <p>
            {{ Auth::user()->name }}さんお疲れ様です！
        </p>
    </div>
    <div class="timestamp__container">
        <form  class="timestamp" action="{{ route('work_start')}}" method="post">
            @csrf
            <button class="timestamp__button" type="submit" {{ $workStarted ? 'disabled' : '' }}>勤務開始</button>
        </form>
        <form  class="timestamp" action="{{ route('work_end')}}" method="post">
            @csrf
            <button class="timestamp__button" type="submit" {{ $workStarted && !$workEnded ? '' : 'disabled'}}>勤務終了</button>
        </form>
        <form  class="timestamp" action="{{ route('break_start')}}" method="post">
            @csrf
            <button class="timestamp__button" type="submit" {{ $workStarted && !$workEnded && !$breakStarted ? '' : 'disabled'}}>休憩開始</button>
        </form>
        <form  class="timestamp" action="{{ route('break_end')}}" method="post">
            @csrf
            <button class="timestamp__button" type="submit" {{ $breakStarted && !$workEnded ? '' : 'disabled'}}>休憩終了</button>
        </form>
    </div>
</div>



@endsection
