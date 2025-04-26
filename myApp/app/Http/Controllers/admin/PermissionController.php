<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all(); // Lấy tất cả nhóm người dùng
        return view('admin.permission.index', compact('roles'));
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
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        // Quyền hiện tại của nhóm này
        $rolePermissions = $role->permissions->pluck('permission_id')->toArray();


        // Nhóm các quyền theo chức năng
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission->permission_name);
            $group = ucfirst($parts[0]); // user.view → User
            $groupedPermissions[$group][] = $permission;
        }

        return view('admin.permission.edit', compact('role', 'groupedPermissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions); // Cập nhật lại các quyền
        return redirect()->route('show-permission.index')->with('success', 'Cập nhật quyền thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
