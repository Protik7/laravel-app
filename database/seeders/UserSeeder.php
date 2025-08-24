<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'role_id' => 2
            ],
            [
                'name' => 'User',
                'email' => 'user@test.com',
                'role_id' => 1
            ]
        ];

        foreach ($users as $user)
        {
            $is_user = User::where('email', $user['email'])->first() ?? null;
            if (!$is_user) {
                User::factory()->create($user);
            }
        }
    }
}
