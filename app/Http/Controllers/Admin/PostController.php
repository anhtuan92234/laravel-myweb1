<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // $list = DB::table('posts')
        //     ->join('users', 'posts.user_id', '=', 'users.id')
        //     ->select(
        //         'posts.id',
        //         'posts.title',
        //         'posts.slug',
        //         'posts.image',
        //         'posts.status',
        //         'posts.created_at',
        //         'users.fullname'
        //     )
        //     ->orderBy('posts.id', 'desc')
        //     ->get();

        // Sử dụng Eloquent ORM kết hợp với Eager Loading thông qua with()
        $list = Post::with([
            'user:id,fullname' // Nạp trước bảng users, chỉ lấy cột id và fullname
        ])
        ->select(
            'id',
            'title',
            'slug',
            'image',
            'status',
            'created_at',
            'user_id' // BẮT BUỘC phải select khóa ngoại để Eloquent map dữ liệu sang bảng users
        )
        ->orderBy('id', 'desc')
        ->paginate($limit);

        return view('admin.posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
