<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Đọc danh sách quyền và mô tả từ file cấu hình
        $permissionsConfig = config('permission');

        $permissionsArray = array_map(function($permission, $description) {
            return [
                'permission_name' => $permission,
                'description' => $description,
            ];
        }, $permissionsConfig['Permission'], $permissionsConfig['Description']);

        DB::table('permissions')->insert($permissionsArray);
    }
}
