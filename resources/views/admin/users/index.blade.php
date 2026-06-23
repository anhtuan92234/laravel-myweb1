@extends('admin.layouts.admin')

@section('title', 'Người dùng')

@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG / NHÂN VIÊN</h2>

<div class="mb-3">
    <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-lg">
        <i class="bi bi-plus-circle"></i> + Thêm mới
    </a>
</div>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Tài khoản</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Chức vụ</th>
            <th>Trạng thái</th>
            <th">Chức năng</th>
        </tr>
    </thead>
    <tbody>
    @forelse($list as $item)
    <tr>
        <td class="text-center">{{ $list->firstItem() + $loop->index }}</td>
        <td><strong>{{ $item->fullname }}</strong></td>
        <td>{{ $item->username }}</td>
        <td>{{ $item->email }}</td>
        <td class="text-center">{{ $item->phone ?? 'Chưa cập nhật' }}</td>
        <td class="text-center">
            @if($item->role == 1)
                <span class="badge bg-primary">Quản lý</span>
            @else
                <span class="badge bg-info text-dark">Nhân viên</span>
            @endif
        </td>
        <td class="text-center">
            @if($item->status == 1)
                <span class="badge bg-success">Kích hoạt</span>
            @else
                <span class="badge bg-secondary">Khóa</span>
            @endif
        </td>
        <td class="text-center">
            <div class="d-flex justify-content-center gap-1">
                <form action="{{ route('admin.users.destroy', $item->id) }}"
                    method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Xóa
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="text-center text-danger py-4">
            Chưa có dữ liệu người dùng / nhân viên
        </td>
    </tr>
    @endforelse
</tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection