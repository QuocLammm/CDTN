<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('product_statistics', function (Blueprint $table) {
            $table->id('stat_id');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('size')->nullable();
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_statistics');
    }
}
