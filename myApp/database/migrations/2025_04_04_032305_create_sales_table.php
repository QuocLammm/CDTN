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
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('SaleID')->unsigned()->primary();
            $table->unsignedInteger('OrderID');
            $table->unsignedInteger('ProductID');
            $table->unsignedInteger('UserID');
            $table->integer('Quantity');
            $table->decimal('Sale_Price', 10, 2);
            $table->datetime('Sale_Date');


            $table->foreign('OrderID')->references('OrderID')->on('orders');
            $table->foreign('ProductID')->references('ProductID')->on('products');
            $table->foreign('UserID')->references('UserID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['OrderID','ProductID','UserID']);
        });
        Schema::dropIfExists('sales');
    }
};
