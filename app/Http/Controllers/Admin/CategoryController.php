<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Danh sách category";
    }

    public function create()
    {
        return "Form thêm category";
    }

    public function store(Request $request)
    {
        return "Lưu category";
    }

    public function show(string $id)
    {
        return "Chi tiết category ID: " . $id;
    }

    public function edit(string $id)
    {
        return "Form sửa category ID: " . $id;
    }

    public function update(Request $request, string $id)
    {
        return "Cập nhật category ID: " . $id;
    }

    public function destroy(string $id)
    {
        return "Xóa category ID: " . $id;
    }
}
