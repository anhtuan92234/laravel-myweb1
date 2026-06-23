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
                    <label for="name" class="form-label font-weight-bold">Họ và tên</label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Nhập họ và tên..." required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label font-weight-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Ví dụ: nguyenvanid@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label font-weight-bold">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu ít nhất 6 ký tự" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label font-weight-bold">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control form-control-lg" placeholder="Nhập số điện thoại...">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label font-weight-bold">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-control form-control-lg" placeholder="Nhập địa chỉ cư trú...">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label font-weight-bold">Vai trò</label>
                    <select name="role" id="role" class="form-select form-select-lg">
                        <option value="user">Khách hàng (User)</option>
                        <option value="admin">Quản trị viên (Admin)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label font-weight-bold">Trạng thái</label>
                    <select name="status" id="status" class="form-select form-select-lg">
                        <option value="1">Kích hoạt</option>
                        <option value="0">Khóa tài khoản</option>
                    </select>
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