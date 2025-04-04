<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'AccountName' => 'admin',
            'RoleID' => 1,
            'Email' => 'admin@admin.com',
            'Password' => bcrypt('123456')
        ],
    ]);
    }
}
