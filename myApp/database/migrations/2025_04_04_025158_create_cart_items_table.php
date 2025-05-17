

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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->unsignedInteger('cart_item_id')->autoIncrement()->primary();
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('product_detail_id');
            $table->integer('quantity');

            $table->foreign('cart_id')->references('cart_id')->on('carts');
            $table->foreign('product_detail_id')->references('product_detail_id')->on('product_details');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['cart_id','product_detail_id']);
        });
        Schema::dropIfExists('cart_items');
    }
};
