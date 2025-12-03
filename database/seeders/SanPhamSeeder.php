<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SanPham;

class SanPhamSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_sanpham' => 1,
                'tensp' => 'Túi mini GG Marmont',
                'anhsp' => 'frontend/upload/CSbNOaunklf0NDNNJH1eQ9RILe9B647zRPYOn4BL.jpg',
                'giasp' => 31250000,
                'mota' => '
                • Có hình trái tim, chiếc túi mini GG Marmont có hình bóng vui tươi bằng da Gucci Rosso Ancora đỏ matelassé chevron mềm mại. Thiết kế nhỏ gọn được hoàn thiện bằng phần cứng Double G đặc trưng với tông màu vàng nhạt.
                • Da Gucci Rosso Ancora đỏ matelassé chevron
                • Phần cứng tông màu vàng nhạt
                • Lớp lót taffeta đỏ
                • Double G
                • Bên trong: 1 khe cắm thẻ
                • Tay cầm có độ dài 3,1
                • Dây đeo vai có thể tháo rời và điều chỉnh được với độ dài 18,9
                • Khóa kéo
                • Trọng lượng: Khoảng 0,36lbs
                • W5,3 x H4,5 x D1
                • Sản xuất tại Ý
                • Phù hợp với Airpods và son môi',
                'giamgia' => 2,
                'giakhuyenmai' => 30625000,
                'soluong' => 10,
                'id_danhmuc' => 9,
            ],
        ];

        foreach ($data as $item) {
            SanPham::create($item);
        }
    }
}
