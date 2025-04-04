

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
            $table->unsignedInteger('CartItemID')->primary();
            $table->unsignedInteger('CartID');
            $table->unsignedInteger('ProductDetailID');
            $table->integer('Quantity');

            $table->foreign('CartID')->references('CartID')->on('carts');
            $table->foreign('ProductDetailID')->references('ProductDetailID')->on('product_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['CartID','ProductDetailID']);
        });
        Schema::dropIfExists('cart_items');
    }
};
