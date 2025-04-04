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
        Schema::create('revenue_statistics', function (Blueprint $table) {
            $table->bigIncrements('RevenueID')->unsigned()->primary();
            $table->decimal('TotalRevenue', 10, 2);
            $table->string('Period', 50);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue_statistics');
    }
};
