<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $workStart = Carbon::createFromTime(rand(8, 18), 0, 0);
        // $workEnd = (clone $workStart)->addHours(rand(8, 10));

        // return [
        //     'user_id' => User::factory(),
        //     'work_date' => $this->faker->date(),
        //     'work_start' => $workStart->toTimeString(),
        //     'work_end' => $workEnd->toTimeString(),
        // ];
    }
}
