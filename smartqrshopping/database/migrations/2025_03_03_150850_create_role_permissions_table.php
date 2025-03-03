<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->integer('RoleID');
            $table->integer('PermissionID');
            $table->primary(['RoleID', 'PermissionID']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
}
