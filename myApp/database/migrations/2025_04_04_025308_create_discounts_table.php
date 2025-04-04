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
            $table->increments('DiscountID')->unsigned()->primary();
            $table->unsignedInteger('ProductID');
            $table->string('DiscountCode', 50);
            $table->text('Description');
            $table->decimal('DiscountAmount', 10, 2);
            $table->date('StartDate');
            $table->date('EndDate');
            $table->tinyInteger('Status')->default(1);

            $table->foreign('ProductID')->references('ProductID')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropForeign('ProductID');
        });
        Schema::dropIfExists('discounts');
    }
};
