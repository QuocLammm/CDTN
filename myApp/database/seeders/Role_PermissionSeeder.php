<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role_PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy tất cả các quyền
        $permissions = DB::table('permissions')->pluck('permission_id');

        // Các quyền mà role_id = 2 ko được có
        $excludedPermissionsForRole2 = [5, 8, 10];

        $rolePermissions = [];

        foreach ($permissions as $permissionId) {
            $rolePermissions[] = [
                'role_id' => 1,
                'permission_id' => $permissionId,
            ];

            // Gán quyền cho role_id = 3, bỏ qua các quyền ko được
            if (!in_array($permissionId, $excludedPermissionsForRole2)) {
                $rolePermissions[] = [
                    'role_id' => 3,
                    'permission_id' => $permissionId,
                ];
            }
        }

        // Chèn dữ liệu vào bảng role_permissions
        DB::table('role_permissions')->insert($rolePermissions);
    }

}
