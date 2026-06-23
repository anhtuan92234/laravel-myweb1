@extends('admin.layouts.admin')

@section('title', 'Thương Hiệu')

@section('content')
<h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU</h2>

<div class="mb-3">
    <a href="{{ route('admin.brands.create') }}" class="btn btn-success btn-lg">
        <i class="bi bi-plus-circle"></i> + Thêm mới
    </a>
</div>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Logo / Hình ảnh</th>
            <th>Mã</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
    @forelse($list as $item)
        <tr>
            <td class="text-center">{{ $list->firstItem() + $loop->index }}</td>
            
            <td class="text-center">
                @if(!empty($item->image) && (str_starts_with($item->image, 'http://') || str_starts_with($item->image, 'https://')))
                    <img src="{{ $item->image }}" alt="{{ $item->brandname }}" width="80" class="img-thumbnail">
                @elseif(!empty($item->image) && file_exists(public_path('uploads/brands/' . $item->image)))
                    <img src="{{ asset('uploads/brands/' . $item->image) }}" alt="{{ $item->brandname }}" width="80" class="img-thumbnail">
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Default" width="80" class="img-thumbnail">
                @endif
            </td>
            
            <td class="text-center fw-bold">{{ $item->id }}</td>
            <td><strong>{{ $item->brandname }}</strong></td>
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
                    <a href="{{ route('admin.brands.edit', $item->id) }}"
                        class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Sửa
                    </a>

                    <form action="{{ route('admin.brands.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không?');">
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
            <td colspan="7" class="text-center text-danger py-4">
                Chưa có dữ liệu thương hiệu
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection