<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::paginate(3); // Hiển thị 3 khách hàng mỗi trang
        return view('admin.customer.index', compact('users'));
    }

    //Hiển thị form tạo mới
    public function create()
    {
        return view('admin.customer.create');
    }

    // Lưu thông tin của người dùng mới
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Phone' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
            'RoleID' => 'required|integer',
            'Date_of_birth' => 'nullable|date',
        ]);

        // Tạo mới user
        User::create([
            'FullName' => $request->FullName,
            'Email' => $request->Email,
            'Password' => null, // Mật khẩu có thể thêm sau nếu cần
            'Phone' => $request->Phone,
            'Address' => $request->Address,
            'RoleID' => $request->RoleID,
            'Status' => 1, // Giả sử trạng thái mặc định là 1 (hoạt động)
            'CreatedAt' => now(),
            'UpdatedAt' => now(),
            'Date_of_birth' => $request->Date_of_birth,
        ]);

        return redirect()->route('customer.index')->with('success', 'Thêm khách hàng thành công!');
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.customer.edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa khách hàng
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy khách hàng!'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Khách hàng đã được xóa!']);
    }



}
