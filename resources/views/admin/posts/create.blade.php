@extends('admin.layouts.admin')

@section('title','Thêm bài viết')

@section('content')

<div class="container-fluid fs-5">

<h2 class="mb-4">THÊM BÀI VIẾT</h2>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="card shadow-sm col-md-9">
    <div class="card-body">
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required> </div> 
                
            <div class="mb-3"> 
                <label class="form-label"> Người đăng </label> 
                <select name="user_id" class="form-select"> 
                    <option value="">--Chọn người đăng--</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id')==$user->id?'selected':'' }}> {{ $user->fullname }} </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label"> Nội dung </label> 
                <textarea name="content" rows="6" class="form-control">{{ old('content') }}</textarea> 
            </div>
            
            <div class="mb-3">
                <label class="form-label d-block"> Trạng thái </label>

                <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status',1)==1?'checked':'' }}>
                <label class="btn btn-outline-success" for="active"> Công khai </label>
                
                <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status',1)==0?'checked':'' }}>
                <label class="btn btn-outline-danger" for="inactive"> Bản nháp </label>
            </div>
            
            <button class="btn btn-primary">
                Lưu bài viết
            </button>
            
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại </a>
        </form>
    </div>
</div>
</div>

<script>
document.getElementById('title').addEventListener('input',function(){
    let slug=this.value
    .toLowerCase()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g,'')
    .replace(/[đĐ]/g,'d')
    .replace(/([^0-9a-z-\s])/g,'')
    .replace(/\s+/g,'-')
    .replace(/-+/g,'-')
    .replace(/^-|-$/g,'');
    document.getElementById('slug').value=slug;
});
</script>

@endsection