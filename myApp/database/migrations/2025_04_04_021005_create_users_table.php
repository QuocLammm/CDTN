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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('UserID')->primary()->unsigned();
            $table->unsignedInteger('RoleID');
            $stringColumns = ['FullName','Address','Phone','Password','AccountName'];
            foreach ($stringColumns as $stringColumn) {
                $table->string($stringColumn, 255)->nullable();
            }

            $table->dateTime('Date_of_Birth')->nullable();
            $table->string('Image',255)->nullable();
            $table->tinyInteger('Gender')->default(1);
            $table->string('Email')->unique();
            $table->tinyInteger('Status')->default(1);
            $table->rememberToken();
            $table->timestamps();

            //Khóa ngoại
            $table->foreign('RoleID')->references('RoleID')->on('roles');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['RoleID']); // Xóa khóa ngoại
        });

        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
