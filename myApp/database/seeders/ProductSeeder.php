<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'supplier_id' => 1,
                'product_name' => 'Giày thể thao Nike Air Max',
                'image' => 'img/products/nike_air_max.jpg',
                'description' => 'Giày chạy bộ cực kỳ êm ái và thời trang từ Nike.',
                'price' => 3290000,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 1,
                'supplier_id' => 2,
                'product_name' => 'Giày Adidas Ultraboost',
                'image' => 'img/products/adidas_ultraboost.jpg',
                'description' => 'Sự kết hợp giữa công nghệ và phong cách thể thao.',
                'price' => 3590000,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'supplier_id' => 3,
                'product_name' => 'Dép Quai Ngang Puma',
                'image' => 'img/products/puma_slides.jpg',
                'description' => 'Dép thời trang, thoải mái, phù hợp đi biển.',
                'price' => 790000,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 3,
                'supplier_id' => 4,
                'product_name' => 'Giày Sneaker Converse Chuck Taylor',
                'image' => 'img/products/converse_chuck.jpg',
                'description' => 'Đôi sneaker huyền thoại cho mọi outfit.',
                'price' => 1690000,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => 4,
                'supplier_id' => 5,
                'product_name' => 'Giày Vans Old Skool',
                'image' => 'img/products/vans_old_skool.jpg',
                'description' => 'Biểu tượng của văn hóa skateboard thế giới.',
                'price' => 1590000,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
