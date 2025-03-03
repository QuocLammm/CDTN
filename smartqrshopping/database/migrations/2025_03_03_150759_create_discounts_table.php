<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('DiscountID');
            $table->string('DiscountCode', 50)->unique();
            $table->text('Description')->nullable();
            $table->decimal('DiscountAmount', 10, 2)->nullable();
            $table->date('StartDate')->nullable();
            $table->date('EndDate')->nullable();
            $table->boolean('Status')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
