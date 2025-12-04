<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dathang', function (Blueprint $table) {

            $table->unsignedInteger('id_khuyenmai')
                ->nullable()
                ->after('id_dathang');

            $table->foreign('id_khuyenmai')
                ->references('id_khuyenmai')
                ->on('khuyenmai')
                ->onDelete('set null');

            $table->decimal('tiengiam', 15, 2)
                ->default(0)
                ->after('id_khuyenmai');

            $table->decimal('tienphaitra', 15, 2)
                ->default(0)
                ->after('tiengiam');

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

            $table->dropForeign(['id_khuyenmai']);
            $table->dropColumn(['id_khuyenmai', 'tiengiam', 'tienphaitra']);
            $table->integer('trangthai')->default(0)->change();
        });
    }
};
