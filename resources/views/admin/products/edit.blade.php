@extends('admin_layout')
@section('admin_content')

<style>
.promo-title {
    font-size: 22px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}
.promo-title i {
    background: #0d9488;
    padding: 8px;
    border-radius: 8px;
    color: white;
}
.promo-label { font-weight: 600; margin-bottom: 6px; }
.promo-input, .promo-select {
    border-radius: 12px;
    border: 1px solid #d1d5db;
    padding: 10px 14px;
}
.promo-textarea {
    border-radius: 12px;
    border: 1px solid #d1d5db;
    padding: 12px;
    height: 120px;
}
.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.btn-submit {
    background: linear-gradient(to right, #059669, #10b981);
    color: #fff;
    padding: 12px 26px;
    font-weight: 600;
    border-radius: 12px;
}
.btn-cancel {
    background: #e5e7eb;
    padding: 12px 26px;
    border-radius: 12px;
    font-weight: 600;
}
.product-preview {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid #ccc;
}
</style>

<h3 class="promo-title mb-3">
    <i class="bi bi-plus-circle"></i> Thêm sản phẩm mới
</h3>

<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid-2">

        {{-- Tên sản phẩm --}}
        <div>
            <label class="promo-label">Tên sản phẩm *</label>
            <input type="text" name="tensp" class="form-control promo-input" required>
        </div>

        {{-- Giá sản phẩm --}}
        <div>
            <label class="promo-label">Giá (VNĐ) *</label>
            <input type="number" name="giasp" class="form-control promo-input" required>
        </div>

        {{-- Ảnh --}}
        <div>
            <label class="promo-label">Ảnh sản phẩm *</label>
            <input type="file" name="anhsp" class="form-control promo-input" accept="image/*" id="imageInput" required>
            <img id="previewImage" class="product-preview mt-2" style="display:none;">
        </div>

        {{-- Giảm giá %}
        <div>
            <label class="promo-label">Giảm giá (%)</label>
            <input type="number" name="giamgia" class="form-control promo-input" min="0" max="100">
        </div>

        {{-- Số lượng --}}
        <div>
            <label class="promo-label">Số lượng *</label>
            <input type="number" name="soluong" class="form-control promo-input" required>
        </div>

        {{-- Danh mục --}}
        <div>
            <label class="promo-label">Danh mục *</label>
            <select name="id_danhmuc" class="form-select promo-select" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($danhmucs as $dm)
                    <option value="{{ $dm->id_danhmuc }}">{{ $dm->ten_danhmuc }}</option>
                @endforeach
            </select>
        </div>

    </div>

    {{-- Mô tả --}}
    <div class="mt-3">
        <label class="promo-label">Mô tả</label>
        <textarea name="mota" class="form-control promo-textarea"></textarea>
    </div>

    {{-- Buttons --}}
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('product.index') }}" class="btn btn-cancel">Hủy bỏ</a>
        <button type="submit" class="btn btn-submit">Thêm mới</button>
    </div>

</form>

{{-- Script Preview ảnh --}}
<script>
document.getElementById("imageInput").addEventListener("change", function(e) {
    const img = document.getElementById("previewImage");
    img.src = URL.createObjectURL(e.target.files[0]);
    img.style.display = "block";
});
</script>

@endsection
