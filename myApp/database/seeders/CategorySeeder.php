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
        ];

        DB::table('categories')->insert($categories);
    }
}
