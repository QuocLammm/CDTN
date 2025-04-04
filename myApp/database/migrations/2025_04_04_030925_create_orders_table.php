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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('OrderID')->unsigned()->primary();
            $table->unsignedInteger('UserID');
            $table->decimal('TotalAmount', 10, 2);
            $table->enum('Status', ['Pending', 'Processing', 'Completed', 'Cancelled'])->default('Completed');
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('UserID');
        });
        Schema::dropIfExists('orders');
    }
};
