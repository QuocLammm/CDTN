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
        Schema::create('product_qrcodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->unique(); // Mỗi sản phẩm có 1 QR
            $table->text('qr_data');  // Nội dung chứa trong mã QR
            $table->string('qr_image_path'); // Đường dẫn ảnh QR đã lưu
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_qrcodes');
    }
};
