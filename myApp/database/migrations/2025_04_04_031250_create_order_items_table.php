<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('order_item_id')->unsigned()->primary();
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_detail_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);

            $table->foreign('order_id')->references('order_id')->on('orders');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_id');
        });
        Schema::dropIfExists('order_items');
    }
};
