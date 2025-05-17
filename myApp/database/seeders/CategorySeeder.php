<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Giày Thể Thao',
                'description' => 'Giày chuyên dụng cho thể thao và vận động',
                'status' => 1,
            ],
            [
                'category_name' => 'Dép',
                'description' => 'Dép đi trong nhà và ngoài trời',
                'status' => 1,
            ],
            [
                'category_name' => 'Giày Sneaker',
                'description' => 'Sneaker thời trang dành cho giới trẻ',
                'status' => 1,
            ],
            [
                'category_name' => 'Giày Tây',
                'description' => 'Giày da công sở lịch lãm',
                'status' => 1,
            ],
            [
                'category_name' => 'Giày Boot',
                'description' => 'Boot cao cổ phong cách cá tính',
                'status' => 1,
            ],
            // Các loại giày nữ
            [
                'category_name' => 'Giày Cao Gót',
                'description' => 'Giày cao gót thanh lịch cho phái đẹp',
                'status' => 1,
            ],
            [
                'category_name' => 'Giày Búp Bê',
                'description' => 'Giày búp bê dễ thương và thoải mái',
                'status' => 1,
            ],
            [
                'category_name' => 'Giày Sandal',
                'description' => 'Sandal thoáng mát cho mùa hè',
                'status' => 1,
            ],
            [
                'category_name' => 'Giày Đế Bằng',
                'description' => 'Giày đế bằng tiện lợi cho mọi dịp',
                'status' => 1,
            ],
            [
                'category_name' => 'Giày Thể Thao Nữ',
                'description' => 'Giày thể thao dành riêng cho nữ',
                'status' => 1,
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
