<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index() {
        $customers = User::all()->where('RoleID', 2); // Lấy danh sách là khách hàng
        return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
        $roles = Role::pluck('RoleName', 'RoleID');
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
        $data['RoleID'] = 2;
        $data['Gender'] = $data['Gender'] === 'Female' ? 1 : 0;
        $data['Password'] = bcrypt($data['Password']);

        // Xử lý ảnh
        if ($request->hasFile('Image') && $request->file('Image')->isValid()) {
            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists(public_path('/img/customers/'))) {
                mkdir(public_path('/img/customers/'), 0755, true);
            }

            $file = $request->file('Image');
            $fileName = 'user_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/customers/'), $fileName);
            $data['Image'] = '/img/customers/' . $fileName;
        }

        User::create($data);
        return redirect()->route('show-customer.index')->with('success', 'Thêm khách hàng thành công!');
    }


    public function edit($id) {
        $customer = User::findOrFail($id);
        $roles = Role::whereIn('RoleID', [1, 3])
            ->pluck('RoleName', 'RoleID')
            ->toArray();
        $customers = [
            0 => 'Nam',
            1=> 'Nữ',
        ];

        return view('admin.staff.edit', compact('customer', 'roles', 'customers'));
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $data['Gender'] = $data['Gender'] == 1 ? 1 : 0;

        // Xử lý password
        if (!empty($data['Password'])) {
            $data['Password'] = bcrypt($data['Password']);
        } else {
            unset($data['Password']);
        }

        // Xử lý ảnh
        if ($request->hasFile('Image') && $request->file('Image')->isValid()) {
            $file = $request->file('Image');
            $fileName = 'user_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/customers/'), $fileName);
            $data['Image'] = '/img/customers/' . $fileName;
        }
        $customer = User::findOrFail($id);
        $customer->update($data);
        return redirect()->route('show-staff.index')->with('success', 'Cập nhật nhân viên thành công!');
    }

    public function destroy(User $customer) {
        $customer->delete();
        return redirect()->route('show-customer.index')->with('success', 'Khách hàng đã được xóa!');
    }
}
