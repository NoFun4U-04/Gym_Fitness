@extends('admin_layout')
@section('admin_content')

<style>
/* CARD THỐNG KÊ */
.user-stat-card {
    background: #fff;
    padding: 18px 20px;
    border-radius: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    border-left: 6px solid #0ea5e9;
    text-align: center;
}
.user-stat-card h2 {
    font-size: 26px;
    font-weight: 700;
    margin: 0;
}
.user-stat-card span {
    font-size: 14px;
    color: #666;
}

/* TABLE */
.user-table thead th {
    background: black;
    color: #fff;
    padding: 14px 10px;
    text-transform: uppercase;
    white-space: nowrap;
}

.user-table tbody td {
    padding: 14px 10px;
    vertical-align: middle !important;
    text-align: center;
}

.user-avatar {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 50%;
    border: 1px solid #ddd;
}

.role-badge {
    padding: 6px 14px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 12px;
}
.role-admin { background:#ffe4e6; color:#be123c; }
.role-staff { background:#d1fae5; color:#0f766e; }
.role-user  { background:#e0f2fe; color:#0369a1; }

/* BUTTON ACTION */
.btn-action { padding:8px 12px; border:none; border-radius:8px; font-weight:600; }
.btn-edit { background:#facc15; color:#000; }
.btn-delete { background:#dc2626; color:#fff; }
.btn-restore { background:#16a34a; color:#fff; }
.btn-action:hover { opacity:.9; }
</style>

<h1 class="h3 mb-3"><strong>Quản Lý Người Dùng</strong></h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="user-stat-card" style="border-left-color:#0ea5e9;">
            <h2>{{ $stats['total'] }}</h2>
            <span>Tổng người dùng</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="user-stat-card" style="border-left-color:#22c55e;">
            <h2>{{ $stats['active'] }}</h2>
            <span>Đang hoạt động</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="user-stat-card" style="border-left-color:#f59e0b;">
            <h2>{{ $stats['inactive'] }}</h2>
            <span>Đã vô hiệu</span>
        </div>
    </div>

    <div class="col-md-3 text-end">
        <a href="{{ route('users.create') }}" class="btn btn-success px-4 py-2">Thêm người dùng</a>
    </div>

</div>

{{-- ===================== TÌM KIẾM + FILTER ===================== --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <form method="GET" class="w-50">
        <input type="text" name="q" class="form-control"
               placeholder="🔍 Tìm kiếm theo tên, email hoặc SĐT..."
               value="{{ request('q') }}">
    </form>

    <div class="d-flex">

        {{-- FILTER PHÂN QUYỀN --}}
        <form method="GET" class="me-2">
            <select name="role" class="form-select" onchange="this.form.submit()">
                <option value="">📌 Tất cả quyền</option>
                <option value="1" {{ request('role') == 1 ? 'selected' : '' }}>Admin</option>
                <option value="3" {{ request('role') == 3 ? 'selected' : '' }}>Khách</option>
            </select>
        </form>

        {{-- FILTER TRẠNG THÁI --}}
        <form method="GET">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">📚 Tất cả trạng thái</option>
                <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Vô hiệu</option>
            </select>
        </form>

    </div>

</div>


<table class="table table-hover user-table">
<thead>
    <tr>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Địa chỉ</th>
        <th>Phân quyền</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
</thead>

<tbody>
    @foreach($users as $u)
    <tr>
        <td class="fw-bold">{{ $u->hoten }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->sdt }}</td>
        <td>{{ $u->diachi }}</td>

        <td>
            @if($u->id_phanquyen == 1)
                <span class="role-badge role-admin">Admin</span>
            @elseif($u->id_phanquyen == 2)
                <span class="role-badge role-staff">Quản trị viên</span>
            @else
                <span class="role-badge role-user">Khách</span>
            @endif
        </td>

        <td>
            @if($u->trang_thai == 1)
                <span class="status-badge status-active">Hoạt động</span>
            @else
                <span class="status-badge status-out">Vô hiệu</span>
            @endif
        </td>

        <td>

            <a href="{{ route('users.edit', $u->id_nd) }}" class="btn-action btn-edit">Sửa</a>

            @if($u->trang_thai == 1)
            <form method="POST" class="d-inline" action="{{ route('users.destroy', $u->id_nd) }}">
                @csrf @method('DELETE')
                <button type="button" class="btn-action btn-delete btn-delete-confirm">Vô hiệu</button>
            </form>
            @else
            <a href="{{ route('users.restore', $u->id_nd) }}" class="btn-action btn-restore">Khôi phục</a>
            @endif

        </td>
    </tr>
    @endforeach
</tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.btn-delete-confirm').forEach(btn => {
    btn.addEventListener('click', function(){
        let form = this.closest('form');

        Swal.fire({
            title: 'Vô hiệu hóa người dùng?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'Vô hiệu',
            cancelButtonText: 'Hủy'
        }).then(result => {
            if(result.isConfirmed) form.submit();
        });
    });
});
</script>

@endsection
