<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionHelper
{
    public static function getUserPermissions()
    {
        $userId = Auth::id();

        if (!$userId) {
            return collect(); // Trả về collection rỗng nếu chưa đăng nhập
        }

        return DB::table('permission_user')
            ->join('permissions', 'permissions.permission_id', '=', 'permission_user.permission_id')
            ->where('permission_user.user_id', $userId)
            ->pluck('permissions.permission_name'); // -> collection các permission_name
    }
}
