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
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('discount_id')->unsigned()->primary();
            $table->unsignedInteger('product_id');
            $table->string('discount_code', 50);
            $table->text('description');
            $table->decimal('discount_amount', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status')->default(1);

            $table->foreign('product_id')->references('product_id')->on('products');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropForeign('product_id');
        });
        Schema::dropIfExists('discounts');
    }
};
