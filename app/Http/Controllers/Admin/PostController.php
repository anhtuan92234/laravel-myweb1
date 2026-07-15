<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;


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
        $users = User::select('id', 'fullname')
        ->orderBy('fullname')
        ->get();
        
        return view('admin.posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'user_id' => $request->user_id,
                'status' => $request->status
            ]);
    
            return redirect()
                ->route('admin.posts.index')
                ->with('success','Thêm bài viết thành công');
        } catch (\Exception $e){
    
            return back()
                ->withInput()
                ->with('error',$e->getMessage());
        }
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
        $post = Post::find($id);
        
        if(!$post){
            return redirect()
            ->route('admin.posts.index')
            ->with('error','Bài viết không tồn tại');
    }
    $users = User::select('id','fullname')
        ->orderBy('fullname')
        ->get();
    return view('admin.posts.edit',compact('post','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        try{
            $post = Post::find($id);
    
            if(!$post){
                return redirect()
                    ->route('admin.posts.index')
                    ->with('error','Bài viết không tồn tại');
            }
    
            $post->update([
                'title'=>$request->title,
                'slug'=>$request->slug,
                'content'=>$request->content,
                'user_id'=>$request->user_id,
                'status'=>$request->status
            ]);
    
            return redirect()
                ->route('admin.posts.index')
                ->with('success','Cập nhật bài viết thành công');
        }catch(\Exception $e){
    
            return back()
                ->withInput()
                ->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
