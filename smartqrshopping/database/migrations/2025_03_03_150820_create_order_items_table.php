<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('OrderItemID');
            $table->foreignId('OrderID')->constrained('orders')->onDelete('cascade');
            $table->foreignId('ProductDetailID')->constrained('product_details')->onDelete('cascade');
            $table->integer('Quantity');
            $table->decimal('Price', 10, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
