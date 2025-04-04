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
            $table->increments('OrderItemID')->unsigned()->primary();
            $table->unsignedInteger('OrderID');
            $table->unsignedInteger('ProductDetailID');
            $table->integer('Quantity');
            $table->decimal('Price', 10, 2);


            $table->foreign('OrderID')->references('OrderID')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('OrderID');
        });
        Schema::dropIfExists('order_items');
    }
};
