<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'RoleID'=> 1,
            'RoleName'=> 'Admin',
            'Description'=> 'Quản trị viên'
        ]);
        DB::table('roles')->insert([
            'RoleID'=> 2,
            'RoleName'=> 'Customer',
            'Description' => 'Khách hàng'
        ]);
        DB::table('roles')->insert([
            'RoleID'=> 3,
            'RoleName'=> 'Staff',
            'Description' => 'Nhân viên'
        ]);
    }
}
