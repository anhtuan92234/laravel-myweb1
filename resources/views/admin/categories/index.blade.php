@extends('admin.layouts.admin')

@section('title', 'Loại Sản phẩm')

@section('content')
<h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="mb-3">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-lg">
        <i class="bi bi-plus-circle"></i> + Thêm mới
    </a>
</div>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Mã loại</th>
            <th>Tên loại</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th width="120">Chức năng</th>
        </tr>
    </thead>

    <tbody>
    @forelse($list as $item)
        <tr>
            <td class="text-center">{{ $list->firstItem() + $loop->index }}</td>

            <td class="text-center">
                @if(!empty($item->image) && file_exists(public_path('uploads/categories/' . $item->image)))
                    <img
                        src="{{ asset('uploads/categories/' . $item->image) }}"
                        alt="{{ $item->catename }}"
                        width="80"
                        class="img-thumbnail">
                @else
                    <img
                        src="{{ asset('images/default.png') }}"
                        alt="Default"
                        width="80"
                        class="img-thumbnail">
                @endif
            </td>

            <td class="text-center fw-bold">{{ $item->cateid }}</td>
            <td><strong>{{ $item->catename }}</strong></td>
            <td>{{ $item->slug }}</td>

            <td class="text-center">
                @if($item->status == 1)
                    <span class="badge bg-success">Hiển thị</span>
                @else
                    <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>

            <td class="text-center">
                <div class="d-flex justify-content-center gap-1">

                    <a href="{{ route('admin.categories.edit', $item->cateid) }}"
                        class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Sửa
                    </a>

                    <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST" 
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này không?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm" disabled>
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </form>

                </div>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="7" class="text-center text-danger py-4">
                Chưa có dữ liệu loại sản phẩm
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Phân trang --}}
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>

@endsection