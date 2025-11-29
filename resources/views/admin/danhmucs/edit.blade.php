@extends('admin_layout')
@section('admin_content')

<h1 class="h3 mb-3"><strong>Sửa danh mục</strong></h1>

<div class="err">
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</div>

<form method="POST" action="{{ route('danhmuc.update', $danhmuc->id_danhmuc) }}">
    @csrf
    @method('PUT')

    {{-- Tên danh mục --}}
    <div class="mb-3">
        <label class="form-label">Tên danh mục:</label>
        <input type="text"
               class="form-control"
               name="ten_danhmuc"
               value="{{ old('ten_danhmuc', $danhmuc->ten_danhmuc) }}"
               required>
    </div>

    {{-- Danh mục cha --}}
    <div class="mb-3">
        <label class="form-label">Danh mục cha:</label>
        <select name="danh_muc_cha" class="form-select">
            <option value="">Không có</option>

            @foreach($list_danhmucs as $dm)
                {{-- Không cho chọn chính nó --}}
                @if($dm->id_danhmuc != $danhmuc->id_danhmuc)
                    <option value="{{ $dm->id_danhmuc }}"
                        {{ $dm->id_danhmuc == $danhmuc->parent_category_id ? 'selected' : '' }}>
                        {{ $dm->ten_danhmuc }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>

    {{-- Mô tả danh mục --}}
    <div class="mb-3">
        <label class="form-label">Mô tả:</label>
        <textarea class="form-control" name="mo_ta_danh_muc" rows="3">{{ old('mo_ta_danh_muc', $danhmuc->description) }}</textarea>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a class="btn btn-secondary" href="{{ URL::to('/admin/danhmuc') }}">Hủy</a>
    </div>
</form>

@endsection
