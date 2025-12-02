<?php

namespace App\Repositories;

use App\Models\SanPham;

class ProductRepository
{
    public function getAll($filters = [])
    {
        $query = SanPham::with('danhMuc');

        if (!empty($filters['q'])) {
            $query->where('tensp','LIKE','%'.$filters['q'].'%');
        }

        if (!empty($filters['cate'])) {
            $query->where('id_danhmuc', $filters['cate']);
        }

        if ($filters['status'] !== null && $filters['status'] !== '') {
            $query->where('trang_thai', $filters['status']);
        }

        return $query->orderBy('id_sanpham','desc')->paginate(20);
    }

    public function find($id)
    {
        return SanPham::findOrFail($id);
    }

    public function create($data)
    {
        return SanPham::create($data);
    }

    public function update($id, $data)
    {
        $sp = SanPham::findOrFail($id);
        $sp->update($data);
        return $sp;
    }

    public function delete($id)
    {
        $sp = SanPham::findOrFail($id);
        return $sp->delete();
    }
}
