@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('header')
<nav class="header__menu">
    <ul class="header__menu-list">
        <li class="header__menu-item"><a href="/" class="header__menu-link">ホーム</a></li>
        <li class="header__menu-item"><a href="/attendance" class="header__menu-link">日付一覧</a></li>
        <li class="header__menu-item"><a href="/user_list" class="header__menu-link">ユーザーページ</a></li>
        <li class="header__menu-item">
            @if (Auth::check())
            <form action="{{ route('logout') }}" method="post" class="logout-form">
                @csrf
                <input type="submit" class="header__menu-link button-as-link" value="ログアウト">
            </form>
            @endif
        </li>
    </ul>
</nav>
@endsection

@section('content')
<div class="attendance__content">
    <div class="attendance__title">
        <form action="{{ route('attendance') }}" method="get" class="date-nav__form">
            <button type="submit" name="date" value="{{ $previousDate }}" class="date-nav__button">&lt;</button>
            <h2>{{ $date }}</h2>
            <button type="submit" name="date" value="{{ $nextDate }}" class="date-nav__button">&gt;</button>
            <input type="hidden" name="page" value="{{ $currentPage }}">
        </form>
    </div>
    <table class="attendance__table">
        <tr class="attendance__row">
            <th class="attendance__label">名前</th>
            <th class="attendance__label">勤務開始</th>
            <th class="attendance__label">勤務終了</th>
            <th class="attendance__label">休憩時間</th>
            <th class="attendance__label">勤務時間</th>
        </tr>
        @foreach ($users as $user)
                @foreach ($user->attendances as $attendance)
                <tr class="attendance__row">
                    <td class="attendance__data">{{ $user->name }}</td>
                    <td class="attendance__data">{{ $attendance->work_start }}</td>
                    <td class="attendance__data">{{ $attendance->work_end }}</td>
                    <td class="attendance__data">{{ $attendance->formattedBreakTime }}</td>
                    <td class="attendance__data">{{ $attendance->netWorkTime }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
    @if ($showPagination)
    <div class="pagination">
        {{ $users->appends(['date' => $date])->links() }}
    </div>
    @endif
</div>
@endsection
