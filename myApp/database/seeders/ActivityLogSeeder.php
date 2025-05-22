<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run()
    {
        ActivityLog::insert([
            [
                'user_id' => 1,
                'user_name' => 'Cao Nguyễn Quốc Lâm',
                'user_image' => 'images/users/lam.jpg',
                'action' => 'đã hoàn thành đơn hàng #1201',
                'module' => 'orders',
                'created_at' => now()->subMinutes(10),
            ],
            [
                'user_id' => 1,
                'user_name' => 'Cao Nguyễn Quốc Lâm',
                'user_image' => 'images/users/van_a.jpg',
                'action' => 'đã cập nhật sản phẩm "Giày thể thao"',
                'module' => 'products',
                'created_at' => now()->subMinutes(25),
            ],
            [
                'user_id' => 1,
                'user_name' => 'Cao Nguyễn Quốc Lâm',
                'user_image' => 'images/users/thi_b.jpg',
                'action' => 'đã thêm người dùng mới "Lê C"',
                'module' => 'users',
                'created_at' => now()->subHours(1),
            ],
            [
                'user_id' => 1,
                'user_name' => 'Cao Nguyễn Quốc Lâm',
                'user_image' => 'images/users/pham_d.jpg',
                'action' => 'đã đăng nhập hệ thống',
                'module' => 'auth',
                'created_at' => now()->subMinutes(5),
            ],

        ]);
    }
}
