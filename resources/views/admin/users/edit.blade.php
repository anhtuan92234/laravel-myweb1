@extends('admin.layouts.admin')

@section('title', 'Sửa thành viên')

@section('content')

<div class="container-fluid fs-5">

    <h2 class="mb-4">CẬP NHẬT THÀNH VIÊN</h2>

  <x-admin.alert />

    <div class="card shadow-sm col-md-8">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" name="fullname" class="form-control form-control-lg" value="{{ old('fullname',$user->fullname) }}">
                    @error('fullname')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control form-control-lg" value="{{ old('username',$user->username) }}">
                    @error('username')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email',$user->email) }}">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"> Mật khẩu </label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Để trống nếu không đổi mật khẩu">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"> Số điện thoại </label>
                    <input type="text" name="phone" class="form-control form-control-lg" value="{{ old('phone',$user->phone) }}">
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"> Vai trò </label>
                    
                    <select name="role" class="form-select form-select-lg">
                        <option value="2" {{ old('role',$user->role)==2 ? 'selected' : '' }}> Nhân viên </option>
                        <option value="1" {{ old('role',$user->role)==1 ? 'selected' : '' }}> Quản lý </option>
                    </select>
                    
                    @error('role')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label d-block"> Trạng thái </label>

                    <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status',$user->status)==1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active"> Kích hoạt </label>
                    
                    <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status',$user->status)==0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="inactive"> Khóa tài khoản </label>
                    
                    @error('status')
                    <span class="text-danger d-block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"> Cập nhật </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại </a>
            </form>
        </div>
    </div>
</div>
@endsection