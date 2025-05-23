<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('RoleID');
            $table->string('RoleName', 50)->unique();
            $table->text('Description')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
