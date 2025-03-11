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
        Schema::create('news', function (Blueprint $table) {
            $table->id(); // Tạo cột ID tự động tăng
            $table->string('ten'); // Tên tin tức
            $table->string('slug')->unique(); // Slug tin tức
            $table->string('anh')->nullable(); // Ảnh tin tức
            $table->text('noi_dung'); // Nội dung tin tức
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
