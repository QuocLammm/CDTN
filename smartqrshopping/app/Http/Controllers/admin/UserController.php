<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchPerformed = !empty($search);

        $users = Users::where('FullName', 'LIKE', '%' . $search . '%')
            ->paginate(5); // Phân trang 5 người dùng 1 trang

        $totalResults = $users->total(); // Đếm tổng số kết quả
        return view('admin.staff.index', compact('users','search', 'searchPerformed', 'totalResults'));
    }

    //Hiển thị form tạo mới
    public function create()
    {
        $roles = Role::all(); // Fetch all roles from the database
        return view('admin.staff.create', compact('roles'));
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
        Users::create([
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

        return redirect()->route('staff.index')->with('success', 'Thêm khách hàng thành công!');
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $user = Users::findOrFail($id);
        return view('admin.staff.edit', compact('user'));
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

        $user = Users::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('staff.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa khách hàng
    public function destroy($id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy khách hàng!'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Khách hàng đã được xóa!']);
    }

    //Kiểm tra mail là duy nhất
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = Users::where('email', $email)->exists(); // Adjust this according to your User model

        return response()->json(['exists' => $exists]);
    }
}
