<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->count(120)->create();
        for ($i = 1; $i <= 101; $i++) {
            User::create([
                'name' => 'テストユーザー' . $i,
                'email' => 'test' . $i . '@test.com',
                'password' => Hash::make(str_repeat((string)$i, 8)),
                'email_verified_at' => now(),
            ]);
        }
    }
}
