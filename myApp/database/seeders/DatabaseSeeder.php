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
        $this->call([
            //Các seeder
            RoleSeeder::class,
            PermissionSeeder::class,
            Role_PermissionSeeder::class,
            UserSeeder::class,
            PermissionUserSeeder::class,
            SupplierSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductDetailsSeeder::class,
            ActivityLogSeeder::class,
            ProductReviewSeeder::class,
            SettingSeeder::class
        ]);
    }
}
