<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // $list = DB::table('users')
        //     ->select('id', 'fullname', 'username', 'email', 'phone', 'role', 'status')
        //     ->orderBy('id', 'desc')
        //     ->get();

        // $list = User::orderBy('id', 'desc')
        // ->paginate($limit);

        $list = User::select('id', 'fullname', 'username', 'email', 'phone', 'role', 'status')
        ->orderBy('id', 'desc')
        ->paginate($limit);

        return view('admin.users.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'fullname.required' => 'Vui lòng nhập họ và tên!',
            'username.required' => 'Vui lòng nhập tên tài khoản!',
            'username.unique'   => 'Tên tài khoản này đã tồn tại!',
            'email.required'    => 'Vui lòng nhập địa chỉ email!',
            'email.unique'      => 'Email này đã được sử dụng!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min'      => 'Mật khẩu phải chứa ít nhất 6 ký tự!',
        ]);

        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => $request->role ?? 'user',
            'status'   => $request->status ?? 1,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Thêm thành viên mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $data = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'status'   => $request->status,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành viên thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa thành viên thành công!');
    }
}
