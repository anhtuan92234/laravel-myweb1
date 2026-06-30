@extends('admin.layouts.admin')

@section('title', 'Sửa thương hiệu')

@section('content')

<div class="container-fluid fs-5">
    <h2 class="mb-4">CẬP NHẬT THƯƠNG HIỆU</h2>
    
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form action="{{ route('admin.brands.update', $brand->id) }}"
            method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Tên thương hiệu</label>
                <input type="text" name="brandname" id="brandname" class="form-control" value="{{ old('brandname',$brand->brandname) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"> Slug </label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug',$brand->slug) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"> Thứ tự sắp xếp </label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$brand->sort_order) }}">
            </div>

            <div class="mb-3">
                <label class="form-label"> Mô tả </label>
                <textarea name="description" rows="4" class="form-control">{{ old('description',$brand->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label d-block"> Trạng thái </label>

                <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status',$brand->status)==1 ? 'checked' : '' }}>
                <label class="btn btn-outline-success" for="active"> Hiển thị </label>

                <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status',$brand->status)==0 ? 'checked' : '' }}>
                <label class="btn btn-outline-danger" for="inactive"> Ẩn </label>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Cập nhật
            </button>
            
            <a href="{{ route('admin.brands.index') }}"
               class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
</div>
</div>

<script>
document.getElementById('brandname').addEventListener('input', function(){
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