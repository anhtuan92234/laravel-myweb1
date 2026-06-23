<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // $list = DB::table('brands')
        // ->select('id', 'brandname', 'slug', 'image', 'status')
        // ->orderBy('sort_order', 'asc')
        // ->get();

        $list = Brand::select('id', 'brandname', 'slug', 'image', 'status')
        ->orderBy('brandname')
        ->paginate($limit);
        
        return view('admin.brands.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brandname' => 'required|max:255',
            'slug'      => 'required|max:255',
        ], [
            'brandname.required' => 'Vui lòng nhập tên thương hiệu!',
            'slug.required'      => 'Vui lòng nhập slug thương hiệu!',
        ]);

        Brand::create([
            'brandname'   => $request->brandname,
            'slug'        => $request->slug,
            'description' => $request->description,
            'sort_order'  => $request->sort_order ?? 1,
            'status'      => $request->status ?? 1,
            // 'image'    => $request->image, (Nếu bạn có xử lý file upload ở bước sau)
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Thêm thương hiệu mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'brandname' => 'required|max:255',
            'slug'      => 'required|max:255',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update([
            'brandname'   => $request->brandname,
            'slug'        => $request->slug,
            'description' => $request->description,
            'sort_order'  => $request->sort_order ?? 1,
            'status'      => $request->status ?? 1,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Cập nhật thông tin thương hiệu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        
        return redirect()->route('admin.brands.index')->with('success', 'Xóa thương hiệu thành công!');
    }
}
