<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_statistics', function (Blueprint $table) {
            $table->bigIncrements('Product_StatID')->unsigned()->primary();
            $table->unsignedInteger('ProductID');
            $table->unsignedInteger('UserID');
            $table->string('Size', 255);
            $table->integer('Quantity');
            $table->timestamps();

            $table->foreign('ProductID')->references('ProductID')->on('products');
            $table->foreign('UserID')->references('UserID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_statistics', function (Blueprint $table) {
            $table->dropForeign(['ProductID','UserID']);
        });
        Schema::dropIfExists('product_statistics');
    }
};
