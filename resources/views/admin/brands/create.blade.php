@extends('admin.layouts.admin')

@section('title', 'Thêm thương hiệu')

@section('content')
<div class="container-fluid fs-5">
    <h2 class="mb-4">THÊM MỚI THƯƠNG HIỆU</h2>
    
    <x-admin.alert />

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form action="{{ route('admin.brands.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="brandname" class="form-label font-weight-bold">Tên thương hiệu</label>
                    <input type="text" name="brandname" id="brandname" class="form-control form-control-lg" value="{{ old('brandname') }}">
                    @error('brandname')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label font-weight-bold">Đường dẫn (Slug)</label>
                    <input type="text" name="slug" id="slug" class="form-control form-control-lg" value="{{ old('slug') }}">
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label font-weight-bold">Thứ tự sắp xếp</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control form-control-lg" value="{{ old('sort_order',1) }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label font-weight-bold">Mô tả</label>
                    <textarea name="description" id="description" class="form-control form-control-lg" rows="3" {{ old('description') }}></textarea>
                </div>

               <div class="mb-3">
                <label class="form-label d-block"> Trạng thái </label>

                <input class="btn-check" type="radio" name="status" id="active" value="1" {{ old('status')=='1' ? 'checked' : '' }}>
                <label class="btn btn-outline-success" for="active"> Hiển thị </label>

                <input class="btn-check" type="radio" name="status" id="inactive" value="0" {{ old('status')=='0' ? 'checked' : '' }}>
                <label class="btn btn-outline-danger" for="inactive"> Ẩn </label>
                
                @error('status')
                <span class="text-danger d-block">{{ $message }}</span>
                @enderror
            </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4 me-2">
                        <i class="bi bi-save"></i> Lưu dữ liệu
                    </button>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary btn-lg px-4">
                        Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Đồng bộ xử lý tự động tạo Slug cho brandname giống y hệt catename của bạn
    document.getElementById('brandname').addEventListener('input', function() {
        let title = this.value;
        let slug = title.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, "") // Xóa dấu tiếng Việt
            .replace(/[đĐ]/g, 'd')
            .replace(/([^0-9a-z-\s])/g, '') // Xóa ký tự đặc biệt
            .replace(/(\s+)/g, '-') // Thay khoảng trắng bằng dấu -
            .replace(/-+/g, '-') // Thu gọn nhiều dấu - liên tiếp
            .replace(/^-+|-+$/g, ''); // Xóa dấu - ở đầu và cuối
        document.getElementById('slug').value = slug;
    });
</script>
@endsection