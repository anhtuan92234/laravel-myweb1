@extends('admin.layouts.admin')

@section('title', 'Thương Hiệu')

@section('content')
<h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU</h2>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Logo / Hình ảnh</th>
            <th>Mã</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if(!empty($item->image) && (str_starts_with($item->image, 'http://') || str_starts_with($item->image, 'https://')))
                    <img src="{{ $item->image }}" alt="{{ $item->brandname }}" width="80" class="img-thumbnail">
                @elseif(!empty($item->image) && file_exists(public_path('uploads/brands/' . $item->image)))
                    <img src="{{ asset('uploads/brands/' . $item->image) }}" alt="{{ $item->brandname }}" width="80" class="img-thumbnail">
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Default" width="80" class="img-thumbnail">
                @endif
            </td>
            <td>{{ $item->id }}</td>
            <td><strong>{{ $item->brandname }}</strong></td>
            <td>{{ $item->slug }}</td>
            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Hiển thị</span>
                @else
                    <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection