<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index(){
        $users = User::whereIn('role_id', [1,3])->get();
        return view('admin.staff.index', compact('users'));
    }

    public function create(){
        $roles = Role::whereIn('role_id', [1, 3])
            ->pluck('role_name', 'role_id')
            ->toArray();
        $users = [
            'Male' => 'Nam',
            'Female' => 'Nữ',
        ];
        // Random pass theo đúng validation
        $password = collect([
            Str::random(1), // lowercase
            strtoupper(Str::random(1)), // uppercase
            rand(0, 9), // number
            collect(['@', '#', '$', '%', '&', '*', '!'])->random() // special char
        ])
            ->merge(str_split(Str::random(4)))
            ->shuffle()
            ->implode('');

        return view('admin.staff.create', compact('roles', 'users', 'password'));
    }

    public function store(UserRequest $request){

        $data = $request->all();
        $data['role_id'] = $request->input('role_id');
        $data['password'] = bcrypt($data['password']);
        $data['gender'] = $data['gender'] === 'Female' ? 1 : 0;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $fileName = 'staff_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Try to move the file and check if it's successful
            $destinationPath = public_path('/img/staff/');
            $file->move($destinationPath, $fileName);

            // Check if the file exists after moving
            if (file_exists($destinationPath . $fileName)) {
                $data['image'] = '/img/staff/' . $fileName;
            } else {
                return back()->withErrors('Không thể lưu ảnh. Vui lòng thử lại.');
            }
        } else {
            return back()->withErrors('Có lỗi khi tải lên ảnh.');
        }

        User::create($data);
        return redirect()->route('show-staff.index')->with('success', 'Thêm nhân viên thành công!');
    }


    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::whereIn('role_id', [1, 3])
            ->pluck('role_name', 'role_id')
            ->toArray();
        $users = [
            0 => 'Nam',
            1=> 'Nữ',
        ];

        return view('admin.staff.edit', compact('user', 'roles', 'users'));
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $data['gender'] = $data['gender'] == 1 ? 1 : 0;

        // Xử lý password
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // Xử lý ảnh
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $fileName = 'user_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/customers/'), $fileName);
            $data['image'] = '/img/customers/' . $fileName;
        }
        $user = User::findOrFail($id);
        $user->update($data);
        return redirect()->route('show-staff.index')->with('success', 'Cập nhật nhân viên thành công!');
    }


    public function destroy(User $user){
        $user->delete();
        return redirect()->route('show-staff.index')->with('success', 'Xóa nhân viên thành công!');
    }

    // Hiển thị form phân quyền
    public function permissions(User $user)
    {
        $permissions = Permission::all(); // Lấy tất cả quyền
        $userPermissions = $user->permissions->pluck('permission_id')->toArray(); // Quyền mà user đang có
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission->permission_name); // VD: user.view
            $group = ucfirst($parts[0]); // 'User'
            $groupedPermissions[$group][] = $permission;
        }


        return view('admin.staff.permissions', compact('user', 'permissions', 'userPermissions','groupedPermissions'));
    }

    // Cập nhật quyền
    public function updatePermissions(Request $request, User $user)
    {
        $request->validate([
            'permissions' => 'array'
        ]);

        if ($request->has('permissions') && is_array($request->permissions)) {
            try {
                // Cập nhật lại permissions
                $user->permissions()->sync($request->permissions);
            } catch (\Exception $e) {
                return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            }
        } else {
            // Nếu không có permissions gửi lên thì xóa hết
            $user->permissions()->detach();
        }

        return redirect()->route('show-staff.index')->with('success', 'Cập nhật quyền thành công!');
    }


}
