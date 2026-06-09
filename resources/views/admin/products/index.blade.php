@extends('admin.layouts.admin')

@section('title', 'Sản phẩm')

@section('content')
<h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

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
        </tr>
    </thead>
    <tbody>
        @foreach($list as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
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
            <td><span class="badge bg-secondary">{{ $item->catename }}</span></td>
            <td><span class="badge bg-info text-dark">{{ $item->brandname ?? 'Không có' }}</span></td>
            <td>{{ number_format($item->price, 0, ',', '.') }}</td>
            <td>
                @if($item->pricediscount > 0)
                    <span class="text-danger font-weight-bold">{{ number_format($item->pricediscount, 0, ',', '.') }}</span>
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
        </tr>
        @endforeach
    </tbody>
</table>
@endsection