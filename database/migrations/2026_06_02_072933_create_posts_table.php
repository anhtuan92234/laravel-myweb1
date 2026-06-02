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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Khóa chính (INT, AUTO_INCREMENT)
            $table->string('title', 200); // Tiêu đề bài viết
            $table->string('slug', 255)->unique(); // Slug duy nhất
            $table->text('content'); // Nội dung bài viết
            $table->string('image', 200)->nullable(); // Hình ảnh đại diện
            $table->tinyInteger('status')->default(1); // 1: hiển thị; 0: ẩn
    
            // Khóa ngoại liên kết với bảng users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete(); // Chống xóa User nếu có bài viết thuộc User đó
            $table->timestamps(); // tạo ra created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
