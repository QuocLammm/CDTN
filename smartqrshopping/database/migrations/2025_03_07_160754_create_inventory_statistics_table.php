<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateInventoryStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_statistics', function (Blueprint $table) {
            $table->id('inventory_stat_id');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_statistics');
    }
}
