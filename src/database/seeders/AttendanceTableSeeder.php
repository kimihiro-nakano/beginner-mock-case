<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::all();

        // foreach ($users as $user) {
        //     Attendance::factory()->count(5)->create(['user_id' => $user->id]);
        // }

        foreach ($users as $user) {
            for ($i = 1; $i < 5; $i++) {
                $workStart = Carbon::createFromTime(rand(8, 10), 0, 0);
                $workEnd = (clone $workStart)->addHours(rand(8, 10));

                Attendance::create([
                    'user_id' => $user->id,
                    'work_date' => now()->subDays($i)->toDateString(),
                    'work_start' => $workStart->toTimeString(),
                    'work_end' => $workEnd->toTimeString(),
                ]);
            }
        }
    }
}
