<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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

    public function store(CategoryRequest $request)
    {
        try {
            Category::create([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            
            return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Thêm danh mục thành công');
        } catch (\Exception $e) {
            return back()
            ->withInput()
            ->with('error', 'Thêm danh mục thất bại');
        }
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()
            ->route('admin.categories.index')
            ->with('error', 'Danh mục không tồn tại');
    }
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest  $request, string $id)
    {
        try {
            $category = Category::find($id);
    
            if (!$category) {
                return redirect()
                    ->route('admin.categories.index')
                    ->with('error', 'Danh mục không tồn tại');
            }
    
            $category->update([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status,
            ]);
    
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Cập nhật danh mục thành công');
    
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        // DB::table('categories')
        // ->where('cateid', $id)
        // ->delete();
        
        // return redirect()->route('admin.categories.index');

        // $category = Category::findOrFail($id);
        // $category->delete();
        
        // return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}
