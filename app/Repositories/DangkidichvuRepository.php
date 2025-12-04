<?php

namespace App\Repositories;

use App\Models\Dangkidichvu;
use Illuminate\Support\Facades\DB;

class DangkidichvuRepository implements IDangkidichvuRepository
{
    /** =========================
     * CRUD
     * ========================= */

    public function getAll()
    {
        return Dangkidichvu::orderBy('id_dang_ky', 'DESC')->paginate(10);
    }

    public function query()
    {
        return Dangkidichvu::query();
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
        return Dangkidichvu::where('id_dang_ky', $id)->update($data);
    }

    public function delete($id)
    {
        return Dangkidichvu::where('id_dang_ky', $id)->delete();
    }


    /** =========================
     * COUNT THỐNG KÊ
     * ========================= */

    public function countAll()
    {
        return Dangkidichvu::count();
    }

    public function countByStatus($status)
    {
        return Dangkidichvu::where('trangthai', $status)->count();
    }


    /** =========================
     * ENUM HANDLER
     * ========================= */

    public function getEnumValues($table, $column)
    {
        $result = DB::select("SHOW COLUMNS FROM {$table} LIKE '{$column}'");

        if (!$result) {
            return [];
        }

        $type = $result[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);

        return str_getcsv($matches[1], ',', "'");
    }

    public function getMonUaThich()
    {
        return $this->getEnumValues('dangkidichvu', 'mon_ua_thich');
    }

    public function getCoSoTap()
    {
        return $this->getEnumValues('dangkidichvu', 'co_so_tap');
    }

    public function getGioMongMuon()
    {
        return $this->getEnumValues('dangkidichvu', 'gio_mong_muon');
    }
}
