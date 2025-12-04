<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhmucSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('danhmuc')->insert([
            // ===== Danh mục cha =====
            [
                'ten_danhmuc'        => 'Quần tập',
                'parent_category_id' => null,
                'status'             => 1,
                'description'        => 'Danh mục các sản phẩm quần '
            ],

            // ===== Danh mục con thuộc Quần áo (id = 1) =====
            [
                'ten_danhmuc'        => 'Áo tập ',
                'parent_category_id' => null,
                'status'             => 1,
                'description'        => 'Áo tập dành cho gym'
            ],
            // ===== Danh mục con thuộc Dụng cụ thể thao (id = 2) =====
            [
                'ten_danhmuc'        => 'Găng tay boxing',
                'parent_category_id' => null,
                'status'             => 1,
                'description'        => 'Găng tay cho tập boxing'
            ],
            [
                'ten_danhmuc'        => 'Dây kháng lực',
                'parent_category_id' => null,
                'status'             => 1,
                'description'        => 'Dây kháng lực hỗ trợ tập luyện'
            ],
        ]);
    }
}
