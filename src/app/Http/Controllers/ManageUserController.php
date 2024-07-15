<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Breaking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function userList(Request $request)
    {

        $users = User::paginate(5);

        return view('userList', compact('users'));
    }
    public function userDetail($id)
    {
        $user = User::find($id);
        $attendances = $user->attendances()->with('breakings')->orderBy('work_date', 'desc')->paginate(5);

        foreach ($attendances as $attendance) {
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

        return view('userDetail', compact('user', 'attendances'));
    }
}
