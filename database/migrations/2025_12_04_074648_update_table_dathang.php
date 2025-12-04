<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dathang', function (Blueprint $table) {

            // Thêm khóa ngoại id_khuyenmai
            $table->unsignedBigInteger('id_khuyenmai')
                  ->nullable()
                  ->after('id'); 

            $table->foreign('id_khuyenmai')
                  ->references('id_khuyenmai')
                  ->on('khuyenmai')
                  ->onDelete('set null');

            // Thêm cột tiền giảm
            $table->decimal('tiengiam', 15, 2)
                  ->default(0)
                  ->after('id_khuyenmai');

            // Thêm cột tiền phải trả
            $table->decimal('tienphaitra', 15, 2)
                  ->default(0)
                  ->after('tiengiam');

            // Sửa cột trạng thái sang ENUM
            $table->enum('trangthai', [
                'Chờ xác nhận',
                'Chờ giao hàng',
                'Đang giao hàng',
                'Hoàn thành',
                'Thất bại',
                'Bị hủy'
            ])->default('Chờ xác nhận')->change();
        });
    }

    public function down()
    {
        Schema::table('dathang', function (Blueprint $table) {

            // Hủy foreign key trước khi xóa cột
            $table->dropForeign(['id_khuyenmai']);
            $table->dropColumn(['id_khuyenmai', 'tiengiam', 'tienphaitra']);

            // Trả về trạng thái kiểu cũ (giả sử int)
            $table->integer('trangthai')->default(0)->change();
        });
    }
};
