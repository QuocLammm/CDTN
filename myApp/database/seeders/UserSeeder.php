<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
                'role_id' => 1,
                'full_name' => 'Cao Nguyễn Quốc Lâm',
                'address' => '123 Admin St',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
                'date_of_birth' => '1990-01-01',
                'image' => 'default.png',
                'gender' => 1,
                'email' => 'quoclam@gmail.com',
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'full_name' => 'User One',
                'address' => '456 Street A',
                'phone' => '0987654321',
                'password' => Hash::make('123456'),
                'date_of_birth' => '1995-02-15',
                'image' => 'default.png',
                'gender' => 2,
                'email' => 'user1@example.com',
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'full_name' => 'User Two',
                'address' => '789 Street B',
                'phone' => '0912345678',
                'password' => Hash::make('123456'),
                'date_of_birth' => '1998-03-20',
                'image' => 'default.png',
                'gender' => 1,
                'email' => 'user2@example.com',
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'full_name' => 'User Three',
                'address' => '321 Street C',
                'phone' => '0909090909',
                'password' => Hash::make('123456'),
                'date_of_birth' => '2000-05-10',
                'image' => 'default.png',
                'gender' => 2,
                'email' => 'user3@example.com',
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => 2,
                'full_name' => 'User Four',
                'address' => '654 Street D',
                'phone' => '0888888888',
                'password' => Hash::make('123456'),
                'date_of_birth' => '2002-07-25',
                'image' => 'default.png',
                'gender' => 1,
                'email' => 'user4@example.com',
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
