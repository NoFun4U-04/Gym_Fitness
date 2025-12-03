<?php

namespace App\Repositories;

use App\Models\Sanpham;

class ProductRepository implements IProductRepository
{
    public function allProduct()
    {
        return Sanpham::where('trang_thai', 1)->get();
    }

    public function featuredProducts()
    {
        return Sanpham::where('noi_bat', 1)
            ->where('trang_thai', 1)
            ->get();
    }

    public function getProductsByCategory($danhmucId)
    {
        return Sanpham::where('id_danhmuc', $danhmucId)
            ->where('trang_thai', 1)
            ->get();
    }

    public function randomProduct()
    {
        return Sanpham::where('trang_thai', 1)
            ->inRandomOrder()
            ->get();
    }

    public function findProduct($id)
    {
        return Sanpham::findOrFail($id);
    }

    public function findByName($name)
    {
        return Sanpham::where('tensp', $name)->first();
    }

    public function storeProduct($data)
    {
        return Sanpham::create($data);
    }

    public function updateProduct($data, $id)
    {
        $product = Sanpham::findOrFail($id);

        // Nếu có upload ảnh mới
        if (isset($data['anhsp']) && $data['anhsp'] instanceof \Illuminate\Http\UploadedFile) {

            $file = $data['anhsp'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('frontend/upload', $filename);

            $data['anhsp'] = 'frontend/upload/' . $filename;

        } else {
            // Không upload → giữ ảnh cũ
            $data['anhsp'] = $product->anhsp;
        }
        return Sanpham::where('id_sanpham', $id)->update($data);
    }

    public function softDelete($id)
    {
        return Sanpham::where('id_sanpham', $id)->update([
            'trang_thai' => 0
        ]);
    }

    public function searchProduct($request)
    {
        $keyword = $request->input('tukhoa');

        return Sanpham::where('tensp', 'LIKE', "%$keyword%")
            ->where('trang_thai', 1)
            ->get();
    }

    public function getAllByDanhMuc($request)
    {
        $query = Sanpham::query()->where('trang_thai', 1);

        if ($request->filled('danhmuc')) {
            $query->where('id_danhmuc', $request->danhmuc);
        }

        return $query->paginate(12);
    }

    public function filterProducts($request)
    {
        $query = Sanpham::query();

        // tìm kiếm
        if (!empty($request->q)) {
            $query->where('tensp', 'LIKE', '%' . $request->q . '%');
        }

        // lọc danh mục
        if (!empty($request->cate)) {
            $query->where('id_danhmuc', $request->cate);
        }

        // lọc trạng thái (CHUẨN để nhận giá trị '0')
        if ($request->trang_thai !== null && $request->trang_thai !== '') {
            $query->where('trang_thai', $request->trang_thai);
        }

        return $query->get();
    }

}
