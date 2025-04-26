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

        $rolePermissions = [];
        foreach ($permissions as $permissionId) {
            $rolePermissions[] = [
                'role_id' => 1,
                'permission_id' => $permissionId,
            ];
        }

        // Chèn vào bảng role_permissions
        DB::table('role_permissions')->insert($rolePermissions);
    }
}
