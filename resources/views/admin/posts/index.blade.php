@extends('admin.layouts.admin')

@section('title', 'Bài viết')

@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT Hệ THỐNG</h2>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề bài viết</th>
            <th>Tác giả (Người đăng)</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
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
            <td><i class="bi bi-person-fill"></i> {{ $item->fullname }}</td>
            <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Công khai</span>
                @else
                    <span class="badge bg-warning text-dark">Bản nháp</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection