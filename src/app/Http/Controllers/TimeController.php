<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Breaking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class TimeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $date = now()->toDateString();

        $lastAttendance = Attendance::where('user_id', $user->id)
            ->orderBy('work_date', 'desc')
            ->first();

        if ($lastAttendance && $lastAttendance->work_date < $date) {
            $lastAttendance = Attendance::create([
                'user_id' => $user->id,
                'work_date' => $date,
            ]);
        }

        $workStarted = Attendance::where('user_id', $user->id)
            ->whereDate('work_date', $date)
            ->whereNotNull('work_start')
            ->exists();

        $workEnded = Attendance::where('user_id', $user->id)
            ->whereDate('work_date', $date)
            ->whereNotNull('work_end')
            ->exists();

        $breakStarted = Breaking::where('user_id', $user->id)
            ->whereHas('attendance', function ($query) use ($date) {
                $query->whereDate('work_date', $date);
            })
            ->whereNull('break_end')
            ->exists();

        return view('index', compact('workStarted', 'workEnded', 'breakStarted'));
    }

    public function workStart(Request $request)
    {
        $user = Auth::user();
        $date = now()->toDateString();

        $attendance = Attendance::firstOrNew([
            'user_id' => $user->id,
            'work_date' => $date,
        ]);

        if (is_null($attendance->work_start)) {
            $attendance->work_start = now();
            $attendance->save();
        }

        return redirect()->back();
    }

    public function workEnd(Request $request)
    {
        $user = Auth::user();
        $date = now()->toDateString();

        $lastAttendance = Attendance::where('user_id', $user->id)
            ->orderBy('work_date', 'desc')
            ->first();

        if ($lastAttendance && $lastAttendance->work_date < $date) {
            $lastAttendance = Attendance::create([
                'user_id' => $user->id,
                'work_date' => $date,
            ]);
        }

        $attendance = Attendance::where('user_id', $user->id)
            ->where('work_date', $date)
            ->firstOrFail();

        if (is_null($attendance->work_end)) {
            $attendance->work_end = now();
            $attendance->save();
        }

        $breaking = Breaking::where('user_id', $user->id)
            ->where('attendance_id', $attendance->id)
            ->whereNull('break_end')
            ->orderBy('break_start', 'desc')
            ->first();

        if ($breaking) {
            $breaking->break_end = $attendance->work_end;
            $breaking->save();
        }

        return redirect()->back();
    }

    public function breakStart(Request $request)
    {
        $user = Auth::user();
        $date = now()->toDateString();

        $attendance = Attendance::firstOrCreate([
            'user_id' => $user->id,
            'work_date' => $date,
        ]);

        Breaking::create([
            'user_id' => $user->id,
            'attendance_id' => $attendance->id,
            'break_start' => now(),
        ]);

        return redirect()->back();
    }

    public function breakEnd(Request $request)
    {
        $user = Auth::user();
        $date = now()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('work_date', $date)
            ->first();

        $breaking = Breaking::where('user_id', $user->id)
            ->where('attendance_id', $attendance->id)
            ->whereNull('break_end')
            ->orderBy('break_start', 'desc')
            ->first();

        if ($breaking) {
            $breaking->break_end = now();
            $breaking->save();
        }

        return redirect()->back();
    }
}
