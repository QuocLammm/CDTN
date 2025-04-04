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
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('NotificationID')->unsigned()->primary();
            $table->unsignedInteger('UserID');
            $table->text('Content');
            $table->tinyInteger('Status')->default(0);
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('UserID');
        });
        Schema::dropIfExists('notifications');
    }
};
