@extends('admin.layouts.admin')

@section('title', 'Sản phẩm')

@section('content')
<h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

<div class="mb-3">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Thêm mới
    </a>
</div>

<table class="table table-bordered table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Giá bán</th>
            <th>Giá giảm</th>
            <th>Trạng thái</th>
            <th width="120">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        {{-- Sử dụng @forelse để phòng trường hợp danh sách trống không có sản phẩm nào --}}
        @forelse($list as $item)
        <tr>
            {{-- CHỈNH SỬA 1: Tính số thứ tự chuẩn khi phân trang thay vì dùng $loop->iteration --}}
            <td>{{ $list->firstItem() + $loop->index }}</td>
            
            <td>
                @if(!empty($item->image) && file_exists(public_path('uploads/products/' . $item->image)))
                    <img src="{{ asset('uploads/products/' . $item->image) }}" alt="{{ $item->productname }}" width="70" class="img-thumbnail">
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Default" width="70" class="img-thumbnail">
                @endif
            </td>
            <td>
                <strong>{{ $item->productname }}</strong>
                <br><small class="text-muted">Slug: {{ $item->slug }}</small>
            </td>
            
            {{-- CHỈNH SỬA 2: Gọi tên danh mục qua relationship với toán tử an toàn ?-> --}}
            <td><span class="badge bg-secondary">{{ $item->category?->catename ?? 'Không có' }}</span></td>
            
            {{-- CHỈNH SỬA 3: Gọi tên thương hiệu qua relationship với toán tử an toàn ?-> --}}
            <td><span class="badge bg-info text-dark">{{ $item->brand?->brandname ?? 'Không có' }}</span></td>
            
            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
            <td>
                @if($item->pricediscount > 0)
                    <span class="text-danger fw-bold">{{ number_format($item->pricediscount, 0, ',', '.') }} đ</span>
                @else
                    <span class="text-muted">Không giảm</span>
                @endif
            </td>
            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">Kinh doanh</span>
                @else
                    <span class="badge bg-danger">Tạm ngưng</span>
                @endif
            </td>
            <td>
                {{-- CHỈNH SỬA 4: Thêm các nút chức năng Thao tác như tài liệu yêu cầu --}}
                <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <a href="{{ route('admin.products.destroy', $item->id) }}" 
                   onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" 
                   class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center text-muted">Không có sản phẩm nào trong hệ thống</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Thanh điều hướng phân trang --}}
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection