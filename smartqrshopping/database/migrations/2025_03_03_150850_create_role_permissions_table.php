<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->foreignId('RoleID')->constrained('roles')->onDelete('cascade');
            $table->foreignId('PermissionID')->constrained('permissions')->onDelete('cascade');
            $table->primary(['RoleID', 'PermissionID']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
}
