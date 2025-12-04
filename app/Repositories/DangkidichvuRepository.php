<?php

namespace App\Repositories;

use App\Models\Dangkidichvu;

class DangkidichvuRepository implements IDangkidichvuRepository
{
    public function getAll()
    {
        return Dangkidichvu::orderBy('id_dang_ky', 'DESC')->paginate(10);
    }

    public function find($id)
    {
        return Dangkidichvu::findOrFail($id);
    }

    public function store(array $data)
    {
        return Dangkidichvu::create($data);
    }

    public function update($id, array $data)
    {
        $item = Dangkidichvu::findOrFail($id);
        return $item->update($data);
    }

    public function delete($id)
    {
        $item = Dangkidichvu::findOrFail($id);
        return $item->delete();
    }
    public function query()
{
    return Dangkidichvu::query();
}

public function countAll()
{
    return Dangkidichvu::count();
}

public function countByStatus($status)
{
    return Dangkidichvu::where('trangthai', $status)->count();
}

}
