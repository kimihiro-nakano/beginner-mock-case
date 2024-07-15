@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/userList.css') }}">
@endsection

@section('header')
<nav class="header__menu">
    <ul class="header__menu-list">
        <li class="header__menu-item"><a href="/" class="header__menu-link">ホーム</a></li>
        <li class="header__menu-item"><a href="/attendance" class="header__menu-link">日付一覧</a></li>
        <li class="header__menu-item"><a href="/user_list" class="header__menu-link">ユーザーページ</a></li>
        <li class="header__menu-item">
            @if (Auth::check())
            <form action=" {{ route('logout')}}" method="post" class="logout-form">
                @csrf
                <input type="submit" class="header__menu-link button-as-link" value="ログアウト">
            </form>
            @endif
        </li>
    </ul>
</nav>
@endsection

@section('content')
<div class="user-list__content">
    <div class="user-list__title">
        <p>ユーザー一覧</p>
    </div>
    <table class="user-list__table">
        @foreach ($users as $user)
            <tr class="user-list__row">
                <td class="user-list__data">
                    <a href="{{ url('/user_detail/' . $user->id )}}" class="header__menu-link">{{ $user->name }}</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>
@endsection
