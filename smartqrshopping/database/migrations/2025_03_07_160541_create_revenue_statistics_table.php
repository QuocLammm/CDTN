<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('revenue_statistics', function (Blueprint $table) {
            $table->id('revenue_id');
            $table->decimal('total_revenue', 10, 2);
            $table->string('period'); // "daily", "monthly", "yearly", etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('revenue_statistics');
    }
}
