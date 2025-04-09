<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
        $users = User::whereIn('RoleID', [1,3])->get();
        return view('admin.staff.index', compact('users'));
    }

    public function create(){
        return view('admin.staff.create');
    }

    public function store(UserRequest $request){
        $data = $request->all();
        User::create($data);
        return redirect()->route('show-staff.index')->with('success', 'Thêm nhân viên thành công!');
    }

    public function edit(User $user){
        return view('admin.staff.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user){
        $data = $request->all();
        $user->update($data);
        return redirect()->route('show-staff.index')->with('success', 'Cập nhật nhân viên thành công!');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('show-staff.index')->with('success', 'Xóa nhân viên thành công!');
    }
}
