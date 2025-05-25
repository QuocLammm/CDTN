<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Thêm 5 mã giảm giá
        $discounts = [
            [
                'discount_code' => 'WELCOME10',
                'description' => 'Giảm 10% cho đơn hàng đầu tiên',
                'discount_amount' => 10,
                'start_date' => $now->format('Y-m-d'),
                'end_date' => $now->copy()->addMonth()->format('Y-m-d'),
                'status' => 1,
            ],
            [
                'discount_code' => 'SUMMER15',
                'description' => 'Giảm 15% cho mùa hè',
                'discount_amount' => 15,
                'start_date' => $now->format('Y-m-d'),
                'end_date' => $now->copy()->addMonths(2)->format('Y-m-d'),
                'status' => 1,
            ],
            [
                'discount_code' => 'ALL5',
                'description' => 'Giảm 5% cho toàn bộ sản phẩm',
                'discount_amount' => 5,
                'start_date' => $now->format('Y-m-d'),
                'end_date' => $now->copy()->addWeeks(3)->format('Y-m-d'),
                'status' => 1,
            ],
            [
                'discount_code' => 'CATEGORY20',
                'description' => 'Giảm 20% cho danh mục điện tử',
                'discount_amount' => 20,
                'start_date' => $now->format('Y-m-d'),
                'end_date' => $now->copy()->addMonths(1)->format('Y-m-d'),
                'status' => 1,
            ],
            [
                'discount_code' => 'PRODUCT30',
                'description' => 'Giảm 30% cho sản phẩm đặc biệt',
                'discount_amount' => 30,
                'start_date' => $now->format('Y-m-d'),
                'end_date' => $now->copy()->addDays(10)->format('Y-m-d'),
                'status' => 1,
            ],
        ];

        foreach ($discounts as $discount) {
            $discountId = DB::table('discounts')->insertGetId($discount);

            // Tạo discount_targets tương ứng:
            switch ($discount['discount_code']) {
                case 'WELCOME10':
                case 'SUMMER15':
                    // Áp dụng toàn bộ sản phẩm
                    DB::table('discount_targets')->insert([
                        'discount_id' => $discountId,
                        'target_type' => 'global',
                        'target_id' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;

                case 'ALL5':
                    // Áp dụng toàn bộ sản phẩm
                    DB::table('discount_targets')->insert([
                        'discount_id' => $discountId,
                        'target_type' => 'global',
                        'target_id' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;

                case 'CATEGORY20':
                    // Giả sử category_id = 3 là điện tử
                    DB::table('discount_targets')->insert([
                        'discount_id' => $discountId,
                        'target_type' => 'category',
                        'target_id' => 3,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;

                case 'PRODUCT30':
                    // Giả sử product_id = 10 là sản phẩm đặc biệt
                    DB::table('discount_targets')->insert([
                        'discount_id' => $discountId,
                        'target_type' => 'product',
                        'target_id' => 10,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;
            }
        }
    }
}
