@extends('admin.layouts.admin')

@section('title', 'Thêm loại sản phẩm')

@section('content')
<div class="container-fluid fs-5">
    <h2 class="mb-4">THÊM MỚI LOẠI SẢN PHẨM</h2>

    @if(session('error')) <div class="alert alert-danger"> {{ session('error') }} </div> @endif

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="catename" class="form-label font-weight-bold">Tên loại sản phẩm</label>
                    <input type="text" name="catename" id="catename" class="form-control" value="{{ old('catename') }}" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label font-weight-bold">Đường dẫn (Slug)</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required> </div>
                </div>

                <div class="mb-3"> 
                    <label class="form-label"> Mô tả </label> 
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea> 
                </div>

                <div class="mb-3"> 
                    <label class="form-label d-block"> Trạng thái </label> 

                    <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status',1)==1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active"> Hiển thị </label> 

                    <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status',1)==0 ? 'checked' : '' }}> 
                    <label class="btn btn-outline-danger" for="inactive"> Ẩn </label> 
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i>  Lưu dữ liệu 
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