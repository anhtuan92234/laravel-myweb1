<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
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
    public function store(UserRequest $request)
    {
        try{ 
            User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'phone'    => $request->phone,
                'role'     => $request->role ?? 2,
                'status'   => $request->status ?? 1,
            ]);
            
            return redirect()->route('admin.users.index')->with('success', 'Thêm thành viên mới thành công!');
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
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()
            ->route('admin.users.index')
            ->with('error','Thành viên không tồn tại');
        }

        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::find($id);
            
            if(!$user){
                return redirect()
                ->route('admin.users.index')
                ->with('error','Thành viên không tồn tại');
            }
            $data = [
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'role'     => $request->role,
                'status'   => $request->status,
            ];
            
            if($request->filled('password')){
                $data['password'] = Hash::make($request->password);
            }
            
            $user->update($data);
            
            return redirect()->route('admin.users.index')->with('success','Cập nhật thành viên thành công');
        } catch (\Exception $e){
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
        // $user = User::findOrFail($id);
        // $user->delete();

        // return redirect()->route('admin.users.index')->with('success', 'Xóa thành viên thành công!');
    }
}
