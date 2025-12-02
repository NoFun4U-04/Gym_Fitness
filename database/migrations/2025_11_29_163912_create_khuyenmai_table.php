<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('khuyenmai', function (Blueprint $table) {

            $table->increments('id_khuyenmai'); // promotion_id

            $table->string('ten_khuyenmai'); // promotion_name
            $table->string('ma_khuyenmai')->unique(); // promotion_code

            // Giá trị giảm (số tiền hoặc %)
            $table->integer('gia_tri_giam')->nullable(); // discount_value

            // Loại giảm giá: percent / amount
            $table->enum('loai_giam', ['percent', 'amount'])->default('percent'); // discount_type

            $table->text('mo_ta')->nullable(); // description

            // Điều kiện áp dụng
            $table->integer('don_toi_thieu')->nullable(); // min_order_value
            $table->integer('giam_toi_da')->nullable(); // max_discount_amount

            // Lượt sử dụng
            $table->integer('so_luot_da_dung')->default(0); // usage_count
            $table->integer('gioi_han_luot')->nullable(); // usage_limit

            // Thời gian áp dụng
            $table->dateTime('ngay_bat_dau')->nullable(); // start_date
            $table->dateTime('ngay_ket_thuc')->nullable(); // end_date

            // Trạng thái (1 = hoạt động, 0 = tắt)
            $table->tinyInteger('trang_thai')->default(1);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('khuyenmai');
    }
};
