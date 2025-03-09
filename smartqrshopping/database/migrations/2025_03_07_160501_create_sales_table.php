<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id');
            $table->foreignId('OrderID')->constrained('orders')->onDelete('cascade');
            $table->foreignId('ProductID')->constrained('products')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('sale_price', 10, 2);
            $table->timestamp('sale_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
