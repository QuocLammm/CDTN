<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productDetails = [
            [
                'product_id' => 1,
                'size' => '42',
                'color' => 'Đen',
                'quantity' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 1,
                'size' => '43',
                'color' => 'Trắng',
                'quantity' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2,
                'size' => '41',
                'color' => 'Đen',
                'quantity' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 3,
                'size' => '36',
                'color' => 'Hồng',
                'quantity' => 40,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 4,
                'size' => '39',
                'color' => 'Xanh',
                'quantity' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 5,
                'size' => '40',
                'color' => 'Đen',
                'quantity' => 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('product_details')->insert($productDetails);
    }
}
