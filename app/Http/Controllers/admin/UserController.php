<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Danhmuc;
use App\Models\Phanquyen;
use App\Http\Controllers\Controller;
use App\Repositories\IUserRepository;

class UserController extends Controller
{
    private $repo;
    public function __construct(IUserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $users = $this->repo->all();

        // Tính thống kê người dùng
        $stats = [
            'total'    => $users->count(),
            'active'   => $users->where('trang_thai', 1)->count(),
            'inactive' => $users->where('trang_thai', 0)->count(),
        ];

        return view('admin.users.index', [
            'users' => $users,
            'stats' => $stats
        ]);
    }


    public function create()
    {
        $roles = PhanQuyen::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hoten' => 'required',
            'email' => 'required|email|unique:nguoidung,email',
            'password' => 'required|min:6',
            'sdt' => 'nullable|numeric',
        ]);

        $this->repo->create($request->all());

        return redirect()->route('users.index')->with('success', 'Thêm người dùng thành công!');
    }

    public function edit($id)
    {
        $user = $this->repo->find($id);
        $roles = PhanQuyen::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hoten' => 'required',
            'email' => 'required|email|unique:nguoidung,email,' . $id . ',id_nd',
            'sdt'   => 'nullable|numeric',
        ]);

        $this->repo->updateUser($id, $request->all());

        return redirect()->route('users.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('users.index')->with('success', 'Xóa người dùng thành công!');
    }
}
