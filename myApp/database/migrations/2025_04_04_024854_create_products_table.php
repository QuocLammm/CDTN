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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id')->primary()->unsigned();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('supplier_id');

            $table_columns = ['product_name', 'image'];
            foreach ($table_columns as $column) {
                $table->string($column, 255);
            }

            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id','supplier_id']);
        });
        Schema::dropIfExists('products');
    }
};
