@extends('admin.layouts.admin')

@section('title', 'Sản phẩm')

@section('content')

<h2 class="mb-3">
    DANH SÁCH SẢN PHẨM
</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="mb-3">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle-fill"></i>
        Thêm mới
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
    @forelse($list as $item)

        <tr>
            <td>
                {{ $list->firstItem() + $loop->index }}
            </td>

            <td>
                @if($item->image)
                    <img src="{{ asset('uploads/products/'.$item->image) }}"
                         width="70"
                         class="img-thumbnail">
                @else
                    <img src="{{ asset('images/default.png') }}"
                         width="70"
                         class="img-thumbnail">
                @endif
            </td>

            <td>
                <strong>{{ $item->productname }}</strong>
                <br>
                <small class="text-muted">
                    {{ $item->slug }}
                </small>
            </td>

            <td>
                {{ $item->category?->catename ?? 'Không có' }}
            </td>

            <td>
                {{ $item->brand?->brandname ?? 'Không có' }}
            </td>

            <td>
                {{ number_format($item->price,0,',','.') }} đ
            </td>

            <td>
                @if($item->pricediscount > 0)
                    <span class="text-danger fw-bold">
                        {{ number_format($item->pricediscount,0,',','.') }} đ
                    </span>
                @else
                    <span class="badge bg-danger">
                        Không giảm
                    </span>
                @endif
            </td>

            <td>
                @if($item->status == 1)
                    <span class="badge bg-success">
                        Hiển thị
                    </span>
                @else
                    <span class="badge bg-danger">
                        Ẩn
                    </span>
                @endif
            </td>

            <td>
                <a href="{{ route('admin.products.edit', $item->id) }}"
                   class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <a href="{{ route('admin.products.destroy', $item->id) }}" 
                onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-danger btn-sm"> 
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    @empty

        <tr>
            <td colspan="9" class="text-center">
                Không có sản phẩm nào
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>

@endsection