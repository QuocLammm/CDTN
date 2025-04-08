<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $customers = User::all(); // ->where('RoleID', 2)
        return view('admin.customer.index', compact('customers'));
    }

    public function create() {
        return view('admin.customer.create');
    }

    public function store(Request $request) {
        User::create();
        return redirect()->route('show-customer.index')->with('success', 'Khách hàng đã được thêm!');
    }

    public function edit(User $customer) {
        return view('admin.customer.edit', compact('customer'));
    }

    public function update(Request $request, User $customer) {
        $customer->update();
        return redirect()->route('show-customer.index')->with('success', 'Thông tin khách hàng đã cập nhật!');
    }

    public function destroy(User $customer) {
        $customer->delete();
        return redirect()->route('show-customer.index')->with('success', 'Khách hàng đã được xóa!');
    }
}
