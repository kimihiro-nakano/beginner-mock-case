<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\TimeController;
use App\Models\Attendance;
use Facade\FlareClient\Time\Time;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [RegisteredUserController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'register']);
Route::get('/login', [AuthenticatedSessionController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verifyEmail');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'ご登録のメールアドレスに認証リンクを送信しました。メールをご確認ください。');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/', [TimeController::class, 'index']);
    Route::post('/work_start', [TimeController::class, 'workStart'])->name('work_start');
    Route::post('/work_end', [TimeController::class, 'workEnd'])->name('work_end');
    Route::post('break_start', [TimeController::class, 'breakStart'])->name('break_start');
    Route::post('break_end', [TimeController::class, 'breakEnd'])->name('break_end');
    Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');
    Route::get('/user_list', [ManageUserController::class, 'userList'])->name('user_list');
    Route::get('/user_detail/{id}', [ManageUserController::class, 'userDetail'])->name('user_detail');
    Route::post('/logout', [AttendanceController::class, 'logout'])->name('logout');
});
