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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->unsignedInteger('RoleID');
            $table->unsignedInteger('PermissionID');

            $table->primary(['RoleID', 'PermissionID']);
            $table->foreign('RoleID')->references('RoleID')->on('roles');
            $table->foreign('PermissionID')->references('PermissionID')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropForeign(['RoleID', 'PermissionID']);
        });
        Schema::dropIfExists('role_permissions');
    }
};
