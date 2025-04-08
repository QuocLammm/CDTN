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
            collect(['@', '#', '$', '%', '&', '*', '!'])->random() // special char
        ])
            ->merge(str_split(Str::random(4)))
            ->shuffle()
            ->implode('');

        return view('admin.customer.create', compact('roles', 'customers', 'password'));
    }


    public function store(CustomerRequest $request) {
        $data = $request->all();
        $data['RoleID'] = 2;
        $data['Password'] = bcrypt($data['Password']);

        // Xử lý ảnh nếu có
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $fileName = 'user_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/customers/'), $fileName);
            $data['Image'] = '/img/customers/' . $fileName;
        }

        User::create($data);

        return redirect()->route('admin.customer.index')->with('success', 'Thêm khách hàng thành công!');
    }


    public function edit(User $customer) {
        return view('admin.customer.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, User $customer) {
        $customer->update();
        return redirect()->route('show-customer.index')->with('success', 'Thông tin khách hàng đã cập nhật!');
    }

    public function destroy(User $customer) {
        $customer->delete();
        return redirect()->route('show-customer.index')->with('success', 'Khách hàng đã được xóa!');
    }
}
