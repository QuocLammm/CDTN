<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrCodesTable extends Migration
{
    public function up()
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ProductID');
            $table->string('qr_link');
            $table->text('qr_image_base64');
            $table->timestamp('created_at')->nullable();

            // Nếu có khóa ngoại, thêm vào đây
            $table->foreign('ProductID')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('qr_codes');
    }
}
