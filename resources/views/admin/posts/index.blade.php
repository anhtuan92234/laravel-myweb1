@extends('admin.layouts.admin')

@section('title', 'Bài viết')

@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT HỆ THỐNG</h2>

<div class="mb-3">
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Thêm mới
    </a>
</div>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề bài viết</th>
            <th>Tác giả (Người đăng)</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
            <th width="120">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse($list as $item)
        <tr>
            <td>{{ $list->firstItem() + $loop->index }}</td>
            <td>
                @if(!empty($item->image) && file_exists(public_path('uploads/posts/' . $item->image)))
                    <img src="{{ asset('uploads/posts/' . $item->image) }}" alt="{{ $item->title }}" width="80" class="img-thumbnail">
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Default" width="80" class="img-thumbnail">
                @endif
            </td>
            <td>
                <strong>{{ $item->title }}</strong>
                <br><small class="text-muted">Slug: {{ $item->slug }}</small>
            </td>
            <td><i class="bi bi-person-fill"></i> {{ $item->user?->fullname ?? 'Ẩn danh' }}</td>
            
            <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Công khai</span>
                @else
                    <span class="badge bg-warning text-dark">Bản nháp</span>
                @endif
            </td>
            <td>
                {{-- Bổ sung các nút chức năng đồng bộ như bên Product --}}
                <a href="{{ route('admin.posts.edit', $item->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <a href="{{ route('admin.posts.destroy', $item->id) }}" 
                   onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')" 
                   class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-muted">Không có bài viết nào trong hệ thống</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection