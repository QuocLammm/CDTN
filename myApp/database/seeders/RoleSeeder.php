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
            'role_id'=> 1,
            'role_name'=> 'Admin',
            'description'=> 'Quản trị viên'
        ]);
        DB::table('roles')->insert([
            'role_id'=> 2,
            'role_name'=> 'Customer',
            'description'=> 'Khách hàng'
        ]);
        DB::table('roles')->insert([
            'role_id'=> 3,
            'role_name'=> 'Staff',
            'description'=> 'Nhân viên'
        ]);
    }
}
