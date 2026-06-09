@extends('admin.layouts.admin')

@section('title', 'Loại Sản phẩm')

@section('content')
<h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM</h2>

<div class="mb-3">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-lg">
        <i class="bi bi-plus-circle"></i> + Thêm mới
    </a>
</div>

<table class="table table-bordered table-hover table-striped"></table>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Mã loại</th>
            <th>Tên loại</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th>Chức năng</th> </tr>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $item)
        <tr>
        <td>{{ $loop->iteration }}</td>
            <td>
                @if(!empty($item->image) && file_exists(public_path('uploads/categories/' . $item->image)))
                    <img src="{{ asset('uploads/categories/' . $item->image) }}" alt="{{ $item->catename }}" width="80" class="img-thumbnail">
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Default" width="80" class="img-thumbnail">
                @endif
            </td>
            <td>{{ $item->cateid }}</td>
            <td>{{ $item->catename }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Hiển thị</span>
                @else
                    <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            
            <td>
                <form action="{{ route('admin.categories.destroy', $item->cateid) }}" 
                method="POST" 
                onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này không?');">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Xóa
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection