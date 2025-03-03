<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('CartItemID');
            $table->integer('CartID')->nullable();
            $table->integer('ProductDetailID')->nullable();
            $table->integer('Quantity');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
