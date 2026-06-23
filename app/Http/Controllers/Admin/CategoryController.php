<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // $list = DB::table('categories')
        // ->select('cateid', 'catename', 'slug', 'image', 'status')
        // ->where('status', 1)
        // ->orderBy('catename', 'asc')
        // ->get();

        //ORM Eloquent
        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status')
            ->orderBy('catename')
            ->paginate($limit);
        
        return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // DB::table('categories')->insert([
        //     'catename' => $request->catename,
        //     'slug'     => $request->slug,    
        //     'status'   => 1,   // Đặt trạng thái mặc định là Hiển thị
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        // return redirect()->route('admin.categories.index');

        $request->validate([
            'catename' => 'required|max:255',
            'slug'     => 'required|max:255',
        ], [
            'catename.required' => 'Vui lòng nhập tên loại sản phẩm!',
            'slug.required'     => 'Vui lòng nhập danh mục slug!',
        ]);

        Category::create([
            'catename'    => $request->catename,
            'slug'        => $request->slug,    
            'description' => $request->description,
            'status'      => $request->status ?? 1,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục mới thành công!');
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'catename' => 'required|max:255',
            'slug'     => 'required|max:255',
        ], [
            'catename.required' => 'Vui lòng nhập tên loại sản phẩm!',
            'slug.required'     => 'Vui lòng nhập danh mục slug!',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'catename'    => $request->catename,
            'slug'        => $request->slug,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy(string $id)
    {
        // DB::table('categories')
        // ->where('cateid', $id)
        // ->delete();
        
        // return redirect()->route('admin.categories.index');

        $category = Category::findOrFail($id);
        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}
