
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
            $table->increments('ProductDetailID')->unsigned()->primary();
            $table->unsignedInteger('ProductID');
            $table->string('Size');
            $table->string('Color');
            $table->integer('Quantity')->default(0);
            $table->timestamps();

            $table->foreign('ProductID')->references('ProductID')->on('products');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->dropForeign('ProductID');
        });
        Schema::dropIfExists('product_details');
    }
};



