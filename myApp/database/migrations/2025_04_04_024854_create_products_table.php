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
            $table->increments('ProductID')->primary()->unsigned();
            $table->unsignedInteger('CategoryID');
            $table->unsignedInteger('SupplierID');
            $tablecolumns = ['ProductName', 'Image'];
            foreach ($tablecolumns as $column) {
                $table->string($column, 255);
            }
            $table->text('Description');
            $table->decimal('Price', 10, 2);
            $table->tinyInteger('Status')->default(1);
            $table->timestamps();

            $table->foreign('CategoryID')->references('CategoryID')->on('categories');
            $table->foreign('SupplierID')->references('SupplierID')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['CategoryID','SupplierID']);
        });
        Schema::dropIfExists('products');
    }
};
