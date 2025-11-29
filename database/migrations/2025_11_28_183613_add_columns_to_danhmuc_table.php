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
        Schema::table('danhmuc', function (Blueprint $table) {
            // Thêm danh mục cha (nullable)
            $table->integer('parent_category_id')->nullable()->after('ten_danhmuc');

            // Trạng thái: 1 = hoạt động, 0 = ẩn
            $table->boolean('status')->default(1)->after('parent_category_id');

            // Mô tả danh mục
            $table->text('description')->nullable()->after('status');

            $table->foreign('parent_category_id')->references('id_danhmuc')->on('danhmuc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('danhmuc', function (Blueprint $table) {
            //
        });
    }
};
