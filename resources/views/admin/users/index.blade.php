@extends('admin.layouts.admin')

@section('title', 'Người dùng')

@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG / NHÂN VIÊN</h2>

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
        </tr>
    </thead>
    <tbody>
    @foreach($list as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><strong>{{ $item->fullname }}</strong></td>
        <td>{{ $item->username }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->phone }}</td>
        <td>
            @if($item->role == 1)
                <span class="badge bg-primary">Quản lý</span>
            @else
                <span class="badge bg-info text-dark">Nhân viên</span>
            @endif
        </td>
        <td>
            @if($item->status == 1)
                <span class="badge bg-success">Kích hoạt</span>
            @else
                <span class="badge bg-secondary">Khóa</span>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $list->links() }}
</div>
@endsection