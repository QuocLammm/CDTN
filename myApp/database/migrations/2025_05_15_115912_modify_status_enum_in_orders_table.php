<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Xóa cột status hiện tại
            $table->dropColumn('status');

            // Thêm cột status mới với enum
            $table->enum('status', ['Pending', 'Success', 'Cancelled'])->default('Pending');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->enum('status', ['Pending', 'Success'])->default('Pending');
        });
    }
};
