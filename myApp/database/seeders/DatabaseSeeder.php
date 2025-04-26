<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'pay@example.com',
//        ]);
        $this->call([
            //Các seeder
            RoleSeeder::class,
            PermissionSeeder::class,
            Role_PermissionSeeder::class,
            UserSeeder::class,
            PermissionUserSeeder::class,
        ]);
    }
}
