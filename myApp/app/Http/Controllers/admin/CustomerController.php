<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index() {
        $customers = User::all()->where('role_id', 2); // Lấy danh sách là khách hàng
        return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
        $roles = Role::where('role_id', 2)->pluck('role_name', 'role_id');
        $customers = [
            'Male' => 'Nam',
            'Female' => 'Nữ',
        ];
        $password = collect([
            Str::random(1),
            strtoupper(Str::random(1)),
            rand(0, 9),
            collect(['@', '#', '$', '%', '&', '*', '!'])->random()
        ])
            ->merge(str_split(Str::random(4)))
            ->shuffle()
            ->implode('');

        return view('admin.customer.create', compact('roles', 'customers', 'password'));
    }

    public function store(CustomerRequest $request)
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
            User::create($data);
            return redirect()->route('show-customer.index')->with('success', 'Thêm khách hàng thành công!');
        } catch (\Exception $e) {
            return back()->withErrors('Có lỗi xảy ra: ' . $e->getMessage())
                        ->withInput($request->except('password')); // Giữ lại dữ liệu đã nhập
        }
    }

    public function edit($id) {
        $customer = User::findOrFail($id);
        $roles = Role::where('role_id', 2)
            ->pluck('role_name', 'role_id')
            ->toArray();
        $customers = [
            0 => 'Nam',
            1=> 'Nữ',
        ];

        return view('admin.customer.edit', compact('customer', 'roles', 'customers'));
    }

    public function update(Request $request, $id) {
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
            $file->move(public_path('/images/customers/'), $fileName);
            $data['image'] = '/images/customers/' . $fileName;
        }
        $customer = User::findOrFail($id);
        $customer->update($data);
        return redirect()->route('show-customer.index')->with('success', 'Cập nhật nhân viên thành công!');
    }

    public function destroy(User $customer) {
        $customer->delete();
        return redirect()->route('show-customer.index')->with('success', 'Khách hàng đã được xóa!');
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


        return view('admin.customer.permissions', compact('user', 'permissions', 'userPermissions','groupedPermissions'));
    }

    // Cập nhật quyền
    public function updatePermissions(Request $request, User $user)
    {
        // Chỉ validate permissions thôi
        $request->validate([
            'permissions' => 'array'
        ]);

        if ($request->has('permissions') && is_array($request->permissions)) {
            try {
                // Cập nhật lại permissions
                $user->permissions()->sync($request->permissions); // sync nhanh hơn detach + attach
            } catch (\Exception $e) {
                return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            }
        } else {
            // Nếu không có permissions gửi lên thì xóa hết
            $user->permissions()->detach();
        }

        return redirect()->route('show-customer.index')->with('success', 'Cập nhật quyền thành công!');
    }
}
