<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('OrderID');
            $table->foreignId('UserID')->nullable()->constrained('user')->onDelete('set null');
            $table->decimal('TotalAmount', 10, 2);
            $table->enum('Status', ['Pending', 'Processing', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamp('CreatedAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('UpdatedAt')->default(DB::raw('CURRENT_TIMESTAMP'))->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
