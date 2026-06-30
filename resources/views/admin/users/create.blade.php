@extends('admin.layouts.admin')

@section('title', 'Thêm thành viên')

@section('content')
<div class="container-fluid fs-5">
    <h2 class="mb-4">THÊM MỚI THÀNH VIÊN</h2>

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="fullname" class="form-label font-weight-bold">Họ và tên</label>
                    <input type="text" name="fullname" id="fullname" class="form-control form-control-lg" value="{{ old('fullname') }}" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" class="form-control form-control-lg" value="{{ old('username') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label font-weight-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label font-weight-bold">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label font-weight-bold">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control form-control-lg" value="{{ old('phone') }}">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label font-weight-bold">Vai trò</label>
                    <select name="role" class="form-select form-select-lg">
                        <option value="user"{{ old('role')=='user' ? 'selected' : '' }}> User</option> 
                        <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}> Admin </option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label d-block">Trạng thái</label>
                    
                    <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status',1)==1?'checked':'' }}> 
                    <label class="btn btn-outline-success" for="active"> Kích hoạt </label>
                    
                    <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status',1)==0?'checked':'' }}>
                    <label class="btn btn-outline-danger" for="inactive"> Khóa tài khoản </label>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4 me-2">
                        <i class="bi bi-save"></i> Lưu dữ liệu
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-lg px-4">
                        Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection