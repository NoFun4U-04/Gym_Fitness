@extends('admin_layout')
@section('admin_content')

<style>
      .sp-stat-card {
        background: #fff;
        padding: 18px 20px;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-left: 6px solid #0ea5e9; /* màu mặc định, sẽ override từng card */
        min-height: 90px;
    }

    .sp-stat-card h2 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #111;
    }

    .sp-stat-card span {
        color: #666;
        font-size: 14px;
        margin-top: 4px;
    }

    /* ===== Table header ===== */
    .product-table thead th {
        background: black;
        color: #fff;
        font-weight: 700;
        text-transform: uppercase;
        padding: 14px 10px;
        font-size: 12px;
        text-align: center;
        white-space: nowrap;
        letter-spacing: .5px;
    }

    /* ===== Body row ===== */
    .product-table tbody td {
        vertical-align: middle !important;
        padding: 14px 10px;
        font-size: 14px;
        text-align: center;
        white-space: nowrap;
    }

    /* Cột tên căn trái */
    .product-table tbody td:first-child {
        text-align: left !important;
        white-space: normal;
    }

    /* Badge trạng thái */
    .status-badge {
        padding: 6px 14px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
    }
    .status-active { background: #d1fae5; color: #0f766e; }
    .status-out { background: #ffe4e6; color: #be123c; }
    .status-hidden { background: #fef9c3; color: #92400e; }

    /* Button */
    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }
    .btn-edit { background: #facc15; color: #000; }
    .btn-delete { background: #dc2626; color: #fff; }
    .btn-restore { background: #16a34a; color: #fff; }

    .btn-action:hover { opacity: 0.9; }

    /* Ảnh sản phẩm */
    .product-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

</style>

<h1 class="h3 mb-3"><strong>Quản Lý Sản Phẩm</strong></h1>

{{-- SUCCESS --}}
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- ================= THỐNG KÊ ================= --}}


<div class="row g-3 align-items-center mb-4">

    {{-- Tổng sản phẩm --}}
    <div class="col-md-2">
        <div class="sp-stat-card" style="border-left-color:#0ea5e9;">
            <h2>{{ $stats['total'] }}</h2>
            <span>Tổng sản phẩm</span>
        </div>
    </div>

    {{-- Còn hàng --}}
    <div class="col-md-2">
        <div class="sp-stat-card" style="border-left-color:#22c55e;">
            <h2>{{ $stats['instock'] }}</h2>
            <span>Còn hàng</span>
        </div>
    </div>

    {{-- Sắp hết --}}
    <div class="col-md-2">
        <div class="sp-stat-card" style="border-left-color:#f59e0b;">
            <h2>{{ $stats['low'] }}</h2>
            <span>Sắp hết hàng</span>
        </div>
    </div>

    {{-- Hết hàng --}}
    <div class="col-md-2">
        <div class="sp-stat-card" style="border-left-color:#ef4444;">
            <h2>{{ $stats['out'] }}</h2>
            <span>Hết hàng</span>
        </div>
    </div>

    {{-- Nút tạo --}}
    <div class="col-md-4 text-end">
        <a href="{{ route('product.create') }}"
           class="btn btn-success px-4 py-2">
           Thêm sản phẩm
        </a>
    </div>

</div>


{{-- ===================== TÌM KIẾM ===================== --}}
<div class="d-flex justify-content-between mb-3">

    <form method="GET" class="w-50">
        <input class="form-control" type="text" name="q"
               placeholder="🔍 Tìm kiếm sản phẩm..."
               value="{{ request('q') }}">
    </form>

    <div class="d-flex">

        {{-- Lọc danh mục --}}
        <form method="GET" class="me-2">
            <select name="cate" class="form-select" onchange="this.form.submit()">
                <option value="">📦 Tất cả danh mục</option>
                @foreach($danhmucs as $dm)
                    <option value="{{ $dm->id_danhmuc }}"
                        {{ request('cate') == $dm->id_danhmuc ? 'selected' : '' }}>
                        {{ $dm->ten_danhmuc }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Lọc trạng thái --}}
        <form method="GET">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">📚 Tất cả trạng thái</option>
                <option value="1" {{ request('status')==1?'selected':'' }}>Hiển thị</option>
                <option value="0" {{ request('status')==='0'?'selected':'' }}>Ẩn</option>
            </select>
        </form>

    </div>

</div>

{{-- ===================== BẢNG SẢN PHẨM ===================== --}}
<table class="table table-hover product-table">
    <thead>
        <tr>
            <th>ẢNH</th>
            <th>SẢN PHẨM</th>
            <th>GIÁ BÁN</th>
            <th>GIẢM GIÁ</th>
            <th>SỐ LƯỢNG</th>
            <th>DANH MỤC</th>
            <th>TRẠNG THÁI</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sanphams as $sp)
        <tr>
            {{-- ẢNH --}}
            <td>
                <img src="/{{ $sp->anhsp }}" class="product-img">
            </td>

            {{-- TÊN --}}
            <td class="fw-bold">{{ $sp->tensp }}</td>

            {{-- GIÁ --}}
            <td>{{ number_format($sp->giasp) }} VNĐ</td>

            {{-- GIẢM GIÁ --}}
            <td>{{ $sp->giamgia }}%</td>

            {{-- SỐ LƯỢNG --}}
            <td>{{ $sp->soluong }}</td>

            {{-- DANH MỤC --}}
            <td>{{ $sp->danhMuc->ten_danhmuc ?? '—' }}</td>

            {{-- TRẠNG THÁI --}}
            <td>
                @if($sp->soluong == 0)
                    <span class="status-badge status-out">Hết hàng</span>
                @elseif($sp->soluong < 10)
                    <span class="status-badge status-hidden">Sắp hết</span>
                @else
                    <span class="status-badge status-active">Còn hàng</span>
                @endif
            </td>

            {{-- ACTION --}}
            <td class="text-center">

                <a href="{{ route('product.edit', $sp->id_sanpham) }}" class="btn-action btn-edit">
                    Sửa
                </a>

                <form method="POST" class="d-inline delete-form"
                      action="{{ route('product.destroy', $sp->id_sanpham) }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-action btn-delete btn-delete-confirm">Xóa</button>
                </form>

            </td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection
