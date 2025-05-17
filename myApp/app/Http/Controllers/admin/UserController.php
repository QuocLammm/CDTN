<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index(){
        $users = User::whereIn('role_id', [1,3])->get();
        return view('admin.staff.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereIn('role_id', [1, 3])
            ->pluck('role_name', 'role_id')
            ->toArray();
        $users = [
            'Male' => 'Nam',
            'Female' => 'Nữ',
        ];

        // Mật khẩu ngẫu nhiên khi tạo mới
        $password = $this->generateRandomPassword();

        return view('admin.staff.create', compact('roles', 'users', 'password'));
    }

    // Phương thức tạo mật khẩu ngẫu nhiên
    public function generateRandomPassword()
    {
        return collect([
            Str::random(1),
            strtoupper(Str::random(1)),
            rand(0, 9), // number
            collect(['@', '#', '$', '%', '&', '*', '!'])->random()
        ])
            ->merge(str_split(Str::random(4)))
            ->shuffle()
            ->implode('');
    }


    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['role_id'] = $request->input('role_id');
        $data['password'] = bcrypt($data['password']);
        $data['gender'] = $data['gender'] === 'Female' ? 1 : 0;

        // Kiểm tra xem ảnh có hợp lệ không
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $fileName = 'staff_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/images/staff/');
            $file->move($destinationPath, $fileName);

            if (file_exists($destinationPath . $fileName)) {
                $data['image'] = '/images/staff/' . $fileName;
            } else {
                return back()->withErrors('Không thể lưu ảnh. Vui lòng thử lại.')
                            ->withInput($request->except('password')); // Giữ lại dữ liệu đã nhập
            }
        } else {
            return back()->withErrors('Có lỗi khi tải lên ảnh.')
                        ->withInput($request->except('password')); // Giữ lại dữ liệu đã nhập
        }

        try {
            $user = User::create($data);

            // Xử lý gán quyền sau khi tạo user
            if ($user) {
                if ($user->role_id == 1) {
                    // Full quyền: lấy tất cả permission
                    $permissionIds = DB::table('permissions')->pluck('permission_id')->toArray();
                } elseif ($user->role_id == 3) {
                    // Bỏ quyền 5,8
                    $permissionIds = DB::table('permissions')
                        ->whereNotIn('permission_id', [5, 8])
                        ->pluck('permission_id')
                        ->toArray();
                } else {
                    // Nếu role_id khác thì không gán quyền (hoặc gán quyền mặc định)
                    $permissionIds = [];
                }

                // Gán quyền cho user
                $dataInsert = [];
                foreach ($permissionIds as $permissionId) {
                    $dataInsert[] = [
                        'user_id' => $user->user_id,
                        'permission_id' => $permissionId,
                    ];
                }
                if (!empty($dataInsert)) {
                    DB::table('permission_user')->insert($dataInsert);
                }
            }

            return redirect()->route('show-staff.index')->with('success', 'Thêm nhân viên thành công!');

        } catch (\Exception $e) {
            return back()->withErrors('Có lỗi xảy ra: ' . $e->getMessage())
                ->withInput($request->except('password'));
        }
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
            $file->move(public_path('/images/staff/'), $fileName);
            $data['image'] = '/images/staff/' . $fileName;
        }
        $user = User::findOrFail($id);
        $user->update($data);
        return redirect()->route('show-staff.index')->with('success', 'Cập nhật nhân viên thành công!');
    }


    public function destroy($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();

        // Kiểm tra xem tài khoản có phải là admin không
        if ($user->role_id == 1) {
            return redirect()->route('show-staff.index')->with('error', 'Không thể xóa tài khoản Admin!');
        }

        try {
            $user->delete();
            return redirect()->route('show-staff.index')->with('success', 'Xóa nhân viên thành công!');
        } catch (\Exception $e) {
            return redirect()->route('show-staff.index')->with('error', 'Xóa thất bại: ' . $e->getMessage());
        }
    }



//    // Hiển thị form phân quyền
//    public function permissions(User $user)
//    {
//        $permissions = Permission::all(); // Lấy tất cả quyền
//        $userPermissions = $user->permissions->pluck('permission_id')->toArray(); // Quyền mà user đang có
//        $groupedPermissions = [];
//        foreach ($permissions as $permission) {
//            $parts = explode('.', $permission->permission_name); // VD: user.view
//            $group = ucfirst($parts[0]); // 'User'
//            $groupedPermissions[$group][] = $permission;
//        }
//
//
//        return view('admin.staff.permissions', compact('user', 'permissions', 'userPermissions','groupedPermissions'));
//    }
//
//    // Cập nhật quyền
//    public function updatePermissions(Request $request, User $user)
//    {
//        $request->validate([
//            'permissions' => 'array'
//        ]);
//
//        if ($request->has('permissions') && is_array($request->permissions)) {
//            try {
//                // Cập nhật lại permissions
//                $user->permissions()->sync($request->permissions);
//            } catch (\Exception $e) {
//                return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
//            }
//        } else {
//            // Nếu không có permissions gửi lên thì xóa hết
//            $user->permissions()->detach();
//        }
//
//        return redirect()->route('show-staff.index')->with('success', 'Cập nhật quyền thành công!');
//    }


}
