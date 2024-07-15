@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/userDetail.css') }}">
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
<div class="user-detail__content">
    <div class="user-detail__title">
        <p>
            {{ $user->name }}さんの勤怠情報
        </p>
    </div>
        <table class="user-detail__table">
        <tr class="user-detail__row">
            <th class="user-detail__label">年月日</th>
            <th class="user-detail__label">勤務開始</th>
            <th class="user-detail__label">勤務終了</th>
            <th class="user-detail__label">休憩時間</th>
            <th class="user-detail__label">勤務時間</th>
        </tr>
        @foreach ($attendances as $attendance)
            <tr class="user-detail__row">
                <td class="user-detail__data">{{ $attendance->work_date }}</td>
                <td class="user-detail__data">{{ $attendance->work_start }}</td>
                <td class="user-detail__data">{{ $attendance->work_end }}</td>
                <td class="user-detail__data">{{ $attendance->formattedBreakTime }}</td>
                <td class="user-detail__data">{{ $attendance->netWorkTime }}</td>
            </tr>
        @endforeach
    </table>
    <div class="pagination">
        {{ $attendances->links() }}
    </div>
</div>



@endsection
