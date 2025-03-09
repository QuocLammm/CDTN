<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('ProductDetailID');
            $table->foreignId('ProductID')->nullable()->constrained('products')->onDelete('set null');
            $table->string('Size', 10)->nullable();
            $table->string('Color', 30)->nullable();
            $table->integer('Quantity')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
