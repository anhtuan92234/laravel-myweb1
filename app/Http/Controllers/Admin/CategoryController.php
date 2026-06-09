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
    return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        DB::table('categories')->insert([
            'catename' => $request->catename,
            'slug'     => $request->slug,    
            'status'   => 1,   // Đặt trạng thái mặc định là Hiển thị
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.categories.index');
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
        DB::table('categories')
        ->where('cateid', $id)
        ->delete();
        
        return redirect()->route('admin.categories.index');
    }
}
