@extends('admin.layouts.admin')

@section('title', 'Sửa loại sản phẩm')

@section('content')

<div class="container-fluid fs-5">
    <h2 class="mb-4">CẬP NHẬT LOẠI SẢN PHẨM</h2>

{{-- Hiển thị lỗi --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên loại sản phẩm</label>
                <input type="text" name="catename" id="catename" class="form-control" value="{{ old('catename', $category->catename) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"> Slug </label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"> Mô tả </label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label d-block"> Trạng thái </label>
                <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status', $category->status) == 1 ? 'checked' : '' }}>

                <label class="btn btn-outline-success" for="active"> Hiển thị </label>
                <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status', $category->status) == 0 ? 'checked' : '' }}>

                <label class="btn btn-outline-danger" for="inactive"> Ẩn </label>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Cập nhật
                </button>
                
                <a href="{{ route('admin.categories.index') }}"
                   class="btn btn-secondary">
                    Quay lại 
                </a>
            </div>
        </form>
    </div>
</div>
</div>

<script>
document.getElementById('catename').addEventListener('input', function () {
    let slug = this.value
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g,'')
        .replace(/[đĐ]/g,'d')
        .replace(/([^0-9a-z-\s])/g,'')
        .replace(/\s+/g,'-')
        .replace(/-+/g,'-')
        .replace(/^-|-$/g,'');
    document.getElementById('slug').value = slug;
});
</script>

@endsection