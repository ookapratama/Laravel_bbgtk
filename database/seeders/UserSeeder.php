<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usr = [
            [
                'name' => 'Andi Laravel',
                'username' => 'pakintaki',
                'email' => 'pakintaki@gmail.com',
                'password' => bcrypt('123'),
                'profile' => 'blank.png',
                'role' => 2,
            ],
            [
                'name' => 'Batta"na',
                'username' => 'pabunobuno',
                'email' => 'bunobuno@gmail.com',
                'password' => bcrypt('123'),
                'profile' => 'blank.png',
                'role' => 5,
            ],
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('123'),
                'profile' => 'blank.png',
                'role' => 1,
            ]
        ];

        foreach ($usr as $v) {
            User::create([
                'name' => $v['name'],
                'username' => $v['username'],
                'email' => $v['email'],
                'password' => $v['password'],
                'profile' => $v['profile'],
                'id_role' => $v['role'],
            ]);
        };
    }
}
