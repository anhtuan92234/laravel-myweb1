@extends('admin.layouts.admin')

@section('title', 'Thêm loại sản phẩm')

@section('content')
<div class="container-fluid fs-5">
    <h2 class="mb-4">THÊM LOẠI SẢN PHẨM</h2>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('error')) <div class="alert alert-danger"> {{ session('error') }} </div> @endif

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="catename" class="form-label">Tên loại sản phẩm</label>
                        <input type="text" name="catename" id="catename" class="form-control" value="{{ old('catename') }}">
                        @error('catename') <span class="text-danger">{{ $message }}</span> @enderror </div>
                        
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
                        @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>

                        <input class="btn-check" type="radio" name="status" id="active" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active"> Hiển thị </label>
                        
                        <input class="btn-check" type="radio" name="status" id="inactive" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive"> Ẩn </label> 
                        @error('status') <span class="text-danger ms-2">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-3"> 
                        <label class="form-label">Mô tả sản phẩm</label>
                        <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Lưu
            </button>
            
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
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