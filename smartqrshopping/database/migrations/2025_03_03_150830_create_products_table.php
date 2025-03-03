<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('ProductID');
            $table->integer('CategoryID')->nullable();
            $table->string('ProductName', 100);
            $table->text('Description')->nullable();
            $table->decimal('Price', 10, 2);
            $table->string('Image')->nullable();
            $table->boolean('Status')->default(1);
            $table->timestamp('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('UpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP'))->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
