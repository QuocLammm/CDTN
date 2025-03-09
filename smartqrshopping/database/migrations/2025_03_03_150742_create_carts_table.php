<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('CartID');
            $table->foreignId('UserID')->nullable()->constrained('user','UserID');
            $table->timestamp('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
