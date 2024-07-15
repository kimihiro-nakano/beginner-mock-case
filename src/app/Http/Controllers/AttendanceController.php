<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Breaking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendance(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $previousDate = Carbon::parse($date)->subDay()->toDateString();
        $nextDate = Carbon::parse($date)->addDay()->toDateString();
        $currentPage = $request->input('page', 1);

        $users = User::whereHas('attendances', function ($query) use ($date) {
            $query->where('work_date', $date);
        })->with(['attendances' => function ($query) use ($date) {
            $query->where('work_date', $date);
        }, 'attendances.breakings'])
            ->paginate(5)
            ->appends(['date' => $date]);

        foreach ($users as $user) {
            foreach ($user->attendances as $attendance) {
                $workStart = Carbon::parse($attendance->work_start);
                $workEnd = Carbon::parse($attendance->work_end);
                $totalWorkTime = $workEnd->diffInSeconds($workStart);

                $breakings = $attendance->breakings;
                $totalBreakTime = 0;

                foreach ($breakings as $breaking) {
                    $breakStart = Carbon::parse($breaking->break_start);
                    $breakEnd = Carbon::parse($breaking->break_end);
                    if ($breakStart && $breakEnd) {
                        $totalBreakTime += $breakEnd->diffInSeconds($breakStart);
                    }
                }

                $netWorkTime = $totalWorkTime - $totalBreakTime;
                $attendance->netWorkTime = gmdate('H:i:s', $netWorkTime);
                $attendance->formattedBreakTime = gmdate('H:i:s', $totalBreakTime);
            }
        }

        $showPagination = $users->total() > 1;

        return view('attendance', compact('users', 'date', 'previousDate', 'nextDate', 'showPagination', 'currentPage'));
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
