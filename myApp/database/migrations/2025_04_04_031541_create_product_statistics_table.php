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
            $table->bigIncrements('product_stat_id')->unsigned()->primary();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->string('size', 255);
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_statistics', function (Blueprint $table) {
            $table->dropForeign(['product_id','user_id']);
        });
        Schema::dropIfExists('product_statistics');
    }
};
