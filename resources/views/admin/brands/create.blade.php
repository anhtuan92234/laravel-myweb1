@extends('admin.layouts.admin')

@section('title', 'Thêm thương hiệu')

@section('content')
<div class="container-fluid fs-5">
    <h2 class="mb-4">THÊM MỚI THƯƠNG HIỆU</h2>

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form action="{{ route('admin.brands.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="brandname" class="form-label font-weight-bold">Tên thương hiệu</label>
                    <input type="text" name="brandname" id="brandname" class="form-control form-control-lg" placeholder="Ví dụ: Apple, Samsung, Sony..." required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label font-weight-bold">Đường dẫn (Slug)</label>
                    <input type="text" name="slug" id="slug" class="form-control form-control-lg" placeholder="Ví dụ: apple, samsung, sony" required>
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label font-weight-bold">Thứ tự sắp xếp</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control form-control-lg" value="1" min="1">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label font-weight-bold">Trạng thái</label>
                    <select name="status" id="status" class="form-select form-select-lg">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label font-weight-bold">Mô tả</label>
                    <textarea name="description" id="description" class="form-control form-control-lg" rows="3" placeholder="Nhập mô tả thương hiệu (nếu có)"></textarea>
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