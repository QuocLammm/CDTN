<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('homepages', function (Blueprint $table) {
            $table->increments('UserID');
            $table->string('FullName', 100);
            $table->string('Email', 100)->unique();
            $table->string('Password', 255);
            $table->string('Phone', 15)->nullable();
            $table->text('Address')->nullable();
            $table->foreignId('RoleID')->nullable()->constrained('roles', 'RoleID');
            $table->boolean('Status')->default(1);
            $table->timestamp('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('UpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP'))->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('Date_of_Birth')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}
