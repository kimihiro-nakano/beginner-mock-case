<?php

namespace Database\Factories;

use App\Models\Breaking;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BreakingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $attendance = Attendance::factory()->create();
        // $workStart = Carbon::parse($attendance->work_start);
        // $breakStart = (clone $workStart)->addHours(rand(2, 4));
        // $breakEnd = (clone $breakStart)->addMinutes(rand(30, 60));

        // return [
        //     'attendance_id' => $attendance->id,
        //     'break_start' => $breakStart->toTimeString(),
        //     'break_end' => $breakEnd->toTimeString(),
        // ];
    }
}
