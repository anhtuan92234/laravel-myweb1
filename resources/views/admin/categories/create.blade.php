@extends('admin.layouts.admin')

@section('title', 'Thêm loại sản phẩm')

@section('content')
<div class="container-fluid fs-5">
    <h2 class="mb-4">THÊM MỚI LOẠI SẢN PHẨM</h2>

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="catename" class="form-label font-weight-bold">Tên loại sản phẩm</label>
                    <input type="text" name="catename" id="catename" class="form-control form-control-lg" placeholder="Ví dụ: Điện thoại, Laptop..." required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label font-weight-bold">Đường dẫn (Slug)</label>
                    <input type="text" name="slug" id="slug" class="form-control form-control-lg" placeholder="Ví dụ: dien-thoai, laptop" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4 me-2">
                        <i class="bi bi-save"></i> Lưu dữ liệu
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-lg px-4">
                        Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('catename').addEventListener('input', function() {
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