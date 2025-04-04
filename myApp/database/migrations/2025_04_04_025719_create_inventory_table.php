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
        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('InventoryID')->unsigned()->primary();
            $table->unsignedInteger('ProductID');
            $table->integer('Quantity');
            $table->time('last_sold_date');
            $table->timestamps();

            $table->foreign('ProductID')->references('ProductID')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory', function (Blueprint $table) {
            $table->dropForeign(['ProductID']);
        });
        Schema::dropIfExists('inventory');
    }
};
