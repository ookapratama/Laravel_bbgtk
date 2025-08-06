<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            ['role' => '-', 'role_name' => 'Super Admin'],
            ['role' => '-', 'role_name' => 'Tenaga Pendidik'],
            ['role' => '-', 'role_name' => 'Tenaga Kepindidikan'],
            ['role' => '-', 'role_name' => 'Stakeholder'],
            ['role' => '-', 'role_name' => 'Pegawai BBGTK'],
        ];

        foreach ($role as $key => $v) {
            Role::create([
                'code' => $v['role'],
                'name' => $v['role_name'],
            ]);
        };
    }
}
