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
        Schema::create('discounts', function (Blueprint $table) {
            $table->unsignedBigInteger('discount_id')->autoIncrement();
            $table->string('discount_code')->unique();
            $table->text('description')->nullable();
            $table->decimal('discount_amount', 8, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('status')->default(1); // 1 = active
            $table->timestamps();
        });

        Schema::create('discount_targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id')->references('discount_id')->on('discounts')->onDelete('cascade');
            $table->enum('target_type', ['product', 'category', 'global']);
            $table->unsignedBigInteger('target_id')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('discount_targets');
    }
};
