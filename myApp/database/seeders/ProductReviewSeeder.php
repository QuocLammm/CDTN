<?php

namespace Database\Seeders;

use App\Models\ProductReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            ProductReview::create([
                'product_id' => rand(1,5),
                'user_id' => rand(1, 5),
                'rating' => rand(1, 5),
                'comment' => rand(0, 1) ? 'Đánh giá thử ' . Str::random(10) : null,
            ]);
        }
    }
}
