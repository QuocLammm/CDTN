<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionIds = DB::table('permissions')->pluck('permission_id');

        $data = [];
        foreach ($permissionIds as $permissionId) {
            $data[] = [
                'user_id' => 1,
                'permission_id' => $permissionId,
            ];
        }

        DB::table('permission_user')->insert($data);
    }

}
