<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('CategoryID');
            $table->string('CategoryName', 100);
            $table->text('Description')->nullable();
            $table->boolean('Status')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
