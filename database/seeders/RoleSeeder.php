<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('roles')->insert([
        //     [
        //         'id' => 1,
        //         'name' => 'User',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Admin',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        // ]);

        $roles = [
            [
                'id' => 1,
                'name' => 'User'
            ],
            [
                'id' => 2,
                'name' => 'Admin'
            ]
        ];

        foreach($roles as $role) {
            Role::firstOrCreate([
                'id' => $role['id']
            ], $role);
        }
    }
}
