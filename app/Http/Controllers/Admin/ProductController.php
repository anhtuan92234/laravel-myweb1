<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    //  public function test1()
    // {
    //     return redirect()->route('admin.home');
    // }

    // // Redirect bằng URL hardcode
    // public function test2()
    // {
    //     return redirect('/admin/dashboard');
    // }
    
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // $list = DB::table('products')
        //     ->join('categories', 'products.cateid', '=', 'categories.cateid') // Dựa trên migration Categories cũ của bạn
        //     ->leftJoin('brands', 'products.brandid', '=', 'brands.id')       // Khóa ngoại brandid kết nối với id của bảng brands
        //     ->select(
        //         'products.id',
        //         'products.productname',
        //         'products.slug',
        //         'products.price',
        //         'products.pricediscount',
        //         'products.image',
        //         'products.status',
        //         'categories.catename',   // Lấy tên loại thay vì lấy ID số
        //         'brands.brandname'       // Lấy tên thương hiệu thay vì lấy ID số
        //     )
        //     ->orderBy('products.productname', 'asc')
        //     ->get();

        $list = Product::with([
            'category:cateid,catename', // Chỉ định nạp các cột cần thiết từ bảng categories
            'brand:id,brandname'        // Chỉ định nạp các cột cần thiết từ bảng brands
        ])
        ->select(
            'id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image',
            'status',
            'cateid',   // Giữ lại khóa ngoại để Eloquent khớp quan hệ của Category
            'brandid'   // Giữ lại khóa ngoại để Eloquent khớp quan hệ của Brand
        )
        ->orderBy('productname', 'asc')
        ->paginate($limit);

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('admin.products.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
