<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('NotificationID');
            $table->integer('UserID')->nullable();
            $table->text('Content')->nullable();
            $table->boolean('Status')->default(0);
            $table->timestamp('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
