@extends('admin_layout')
@section('admin_content')

<h1 class="h3 mb-3"><strong>Danh sách danh mục</strong></h1>

{{-- SUCCESS MESSAGE --}}
@if(session()->has('success'))
    <div class="alert alert-success mb-3">
        {{ session('success') }}
    </div>
@endif

{{-- FILTER --}}
<div class="d-flex align-items-center mb-3">
    <a class="btn btn-primary me-3" href="{{ route('danhmuc.create') }}">Thêm danh mục</a>

    <form action="" method="GET">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">-- Tất cả --</option>
            <option value="1" {{ request('status') === "1" ? 'selected' : '' }}>Hoạt động</option>
            <option value="0" {{ request('status') === "0" ? 'selected' : '' }}>Không hoạt động</option>
        </select>
    </form>
</div>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th width="35%">TÊN DANH MỤC</th>
            <th width="20%">DANH MỤC CHA</th>
            <th width="15%">TRẠNG THÁI</th>
            <th width="30%" class="text-center">HÀNH ĐỘNG</th>
        </tr>
    </thead>

    <tbody>
        @foreach($Danhmucs as $danhmuc)
        <tr>
            <td>{{ $danhmuc->ten_danhmuc }}</td>

            {{-- DANH MỤC CHA --}}
            <td>
                @if($danhmuc->parent_category_id)
                    {{ optional($danhmuc->parent)->ten_danhmuc }}
                @else
                    <span class="text-muted">Không có</span>
                @endif
            </td>

            {{-- TRẠNG THÁI --}}
            <td>
                @if($danhmuc->status == 1)
                    <span class="badge bg-success">Hoạt động</span>
                @else
                    <span class="badge bg-danger">Không hoạt động</span>
                @endif
            </td>

            {{-- ACTION --}}
            <td class="text-center">

                @if($danhmuc->status == 1)
                    {{-- Nếu hoạt động → Sửa + Vô hiệu hoá --}}
                    <a href="{{ route('danhmuc.edit', $danhmuc->id_danhmuc) }}"
                       class="btn btn-warning btn-sm me-2">Sửa</a>

                    <form method="POST"
                          action="{{ route('danhmuc.destroy', $danhmuc->id_danhmuc) }}"
                          class="d-inline delete-form">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                            class="btn btn-danger btn-sm btn-delete"
                            data-url="{{ route('danhmuc.destroy', $danhmuc->id_danhmuc) }}">
                            Vô hiệu hoá
                        </button>
                    </form>
                @else
                    {{-- Nếu không hoạt động → chỉ hiện nút khôi phục --}}
                    <form method="POST"
                          action="{{ route('danhmuc.restore', $danhmuc->id_danhmuc) }}"
                          class="d-inline restore-form">
                        @csrf

                        <button type="button"
                            class="btn btn-success btn-sm btn-restore"
                            data-url="{{ route('danhmuc.restore', $danhmuc->id_danhmuc) }}">
                            Khôi phục
                        </button>
                    </form>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {

        let form = this.closest('form');

        Swal.fire({
            title: "Vô hiệu hoá danh mục?",
            text: "Danh mục sẽ chuyển sang trạng thái không hoạt động.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Vô hiệu hoá",
            cancelButtonText: "Hủy"
        }).then(result => {
            if (result.isConfirmed) {
                form.submit(); // 👉 Gửi form sau khi xác nhận
            }
        });
    });
});


document.querySelectorAll('.btn-restore').forEach(btn => {
    btn.addEventListener('click', function () {

        let form = this.closest('form');

        Swal.fire({
            title: "Khôi phục danh mục?",
            text: "Danh mục sẽ được kích hoạt lại.",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Khôi phục",
            cancelButtonText: "Hủy"
        }).then(result => {
            if (result.isConfirmed) {
                form.submit(); // 👉 Gửi form sau khi xác nhận
            }
        });
    });
});
</script>

@endsection
