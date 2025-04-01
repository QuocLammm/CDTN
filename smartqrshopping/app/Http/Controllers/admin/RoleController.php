<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //Hiển thị danh sách phân quyền
    public function index(Request $request){
        $search = $request->input('search');
        $searchPerformed = !empty($search);

        $roles = Role::where('RoleName', 'LIKE', '%' . $search . '%')
            ->orWhere('Description', 'LIKE', '%' . $search . '%')
            ->paginate(3);

        $totalResults = $roles ->total(); // Đếm tổng số kết quả

        return view('admin.roles.index', compact('roles', 'search', 'searchPerformed', 'totalResults'));
    }
    //Hiển thị trang thêm mới
    public function create(){
        return view('admin.roles.create');
    }
    //Thêm mới chức vụ
    public function store(Request $request){

        $role = new Role();
        $role->RoleName = $request->input('RoleName');
        $role->Description = $request->input('Description');
        $role->save();
        return redirect()->route('roles.index')->with('success', 'Quyền hạng được thêm thành công!');
    }
    //Chỉnh sửa chức vụ
    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $groupedPermissions = [];
        $assignedPermissions = RolePermission::where('RoleID', $id)
            ->pluck('PermissionID')
            ->toArray(); // Get the Permission IDs assigned to the role

        // Group permissions by their type (e.g., 'homepages', 'products')
        foreach ($permissions as $permission) {
            $parts = explode('_', $permission->PermissionName);
            $groupName = ucfirst($parts[1] ?? 'Khác'); // Group by permission type, e.g., 'homepages', 'products'
            $groupedPermissions[$groupName][] = $permission;
        }

        return view('admin.roles.edit', compact('role', 'groupedPermissions', 'permissions', 'assignedPermissions'));
    }


    //Cập nhật chức vụ
    public function update(Request $request, $id) {
        $role = Role::findOrFail($id);
        $role->RoleName = $request->input('RoleName');
        $role->Description = $request->input('Description');
        $role->save();

        // Cập nhật lại quyền của nhóm
        RolePermission::where('RoleID', $id)->delete();
        if ($request->has('permissions')) {
            foreach ($request->permissions as $permissionID) {
                RolePermission::create([
                    'RoleID' => $id,
                    'PermissionID' => $permissionID
                ]);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Cập nhật nhóm quyền thành công!');
    }

    //Xóa chức vụ
    public function destroy($id){
        $role = Role::find($id);
        if (!$role) {
            if (!request()->ajax()) {
                return redirect()->route('roles.index')->with('error', 'Không tìm thấy quyền hạng!');
            }
            return response()->json(['message' => 'Không tìm thấy quyền hạng!'], 404);
        }
        $role->delete();
        if (request()->ajax()) {
            return response()->json(['message' => 'Quyền hạng đã được xóa!']);
        }
        return redirect()->route('roles.index')->with('success', 'Quyền hạng đã được xóa thành công!');
    }
}
