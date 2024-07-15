<?php

namespace Database\Seeders;

use App\Models\Breaking;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BreakingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attendances = Attendance::all();

        foreach ($attendances as $attendance) {
            $workStart = Carbon::parse($attendance->work_start);
            $workEnd = Carbon::parse($attendance->work_end);

            $currentStart = clone $workStart;
            while ($currentStart->lessThan($workEnd)) {
                $breakStart = (clone $currentStart)->addHours(rand(2, 4));

                if ($breakStart->greaterThanOrEqualTo($workEnd)) {
                    break;
                }

                $breakEnd = (clone $breakStart)->addMinutes(rand(30, 60));

                if ($breakEnd->greaterThan($workEnd)) {
                    $breakEnd = clone $workEnd;
                }

                Breaking::create([
                    'attendance_id' => $attendance->id,
                    'user_id' => $attendance->user_id,
                    'break_start' => $breakStart->toTimeString(),
                    'break_end' => $breakEnd->toTimeString(),
                ]);

                $currentStart = (clone $breakEnd);
            }
        }
    }
}
