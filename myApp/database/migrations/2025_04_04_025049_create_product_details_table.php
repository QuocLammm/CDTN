
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
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('product_detail_id')->unsigned()->primary();
            $table->unsignedInteger('product_id');
            $table->string('size');
            $table->string('color');
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->dropForeign('product_id');
        });
        Schema::dropIfExists('product_details');
    }
};



