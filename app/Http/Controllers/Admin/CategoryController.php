<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = DB::table('categories')
        ->select('cateid', 'catename', 'slug', 'image', 'status')
        ->where('status', 1)
        ->orderBy('catename', 'asc')
        ->get();

    // Trả dữ liệu về giao diện tương ứng và truyền biến $list sang
    return view('admin.categories.index', compact('list'));
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
