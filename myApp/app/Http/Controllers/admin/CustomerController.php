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
        $roles = Role::pluck('role_name', 'role_id');
        $customers = [
            'Male' => 'Nam',
            'Female' => 'Nữ',
        ];
        // Random pass theo đúng validation
        $password = collect([
            Str::random(1), // lowercase
            strtoupper(Str::random(1)), // uppercase
            rand(0, 9), // number
            collect(['@', '#', '$', '%', '&', '*', '!'])->random()
        ])
            ->merge(str_split(Str::random(4)))
            ->shuffle()
            ->implode('');

        return view('admin.customer.create', compact('roles', 'customers', 'password'));
    }


    public function store(CustomerRequest $request) {
        $data = $request->all();
        $data['role_id'] = 2;
        $data['password'] = bcrypt($data['password']);
        $data['gender'] = $data['gender'] === 'Female' ? 1 : 0;


        // Xử lý ảnh
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists(public_path('/img/customers/'))) {
                mkdir(public_path('/img/customers/'), 0755, true);
            }

            $file = $request->file('image');
            $fileName = 'user_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/customers/'), $fileName);
            $data['image'] = '/img/customers/' . $fileName;
        }

        User::create($data);
        return redirect()->route('show-customer.index')->with('success', 'Thêm khách hàng thành công!');
    }


    public function edit($id) {
        $customer = User::findOrFail($id);
        $roles = Role::whereIn('role_id', [1, 3])
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
            $file->move(public_path('/img/customers/'), $fileName);
            $data['image'] = '/img/customers/' . $fileName;
        }
        $customer = User::findOrFail($id);
        $customer->update($data);
        return redirect()->route('show-staff.index')->with('success', 'Cập nhật nhân viên thành công!');
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
