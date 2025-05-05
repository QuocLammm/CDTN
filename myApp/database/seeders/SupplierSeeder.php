<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'supplier_name' => 'Nike Việt Nam',
                'phone' => '0901234567',
                'contact_name' => 'Nguyễn Văn A',
                'address' => '123 Đường Nike, Quận 1, TP.HCM',
                'email' => 'contact@nike.vn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_name' => 'Adidas Việt Nam',
                'phone' => '0902345678',
                'contact_name' => 'Trần Thị B',
                'address' => '456 Đường Adidas, Quận 3, TP.HCM',
                'email' => 'contact@adidas.vn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_name' => 'Puma Official',
                'phone' => '0903456789',
                'contact_name' => 'Lê Văn C',
                'address' => '789 Đường Puma, Quận 5, TP.HCM',
                'email' => 'contact@puma.vn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_name' => 'Converse Store',
                'phone' => '0904567890',
                'contact_name' => 'Phạm Thị D',
                'address' => '101 Đường Converse, Quận 7, TP.HCM',
                'email' => 'contact@converse.vn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'supplier_name' => 'Vans Việt Nam',
                'phone' => '0905678901',
                'contact_name' => 'Đỗ Văn E',
                'address' => '202 Đường Vans, Quận Bình Thạnh, TP.HCM',
                'email' => 'contact@vans.vn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}
