<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchPerformed = !empty($search);

        $users = Users::whereIn('RoleID', [1, 3])
            ->where('FullName', 'LIKE', '%' . $search . '%')
            ->paginate(5);

        $totalResults = $users->total();

        return view('admin.staff.index', compact('users','search', 'searchPerformed', 'totalResults'));
    }

    //Hiển thị form tạo mới
    public function create()
    {
        $roles = Role::all(); // Fetch all roles from the database
        return view('admin.staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Phone' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
            'avt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'RoleID' => 'required|integer',
            'Date_of_birth' => 'nullable|date',
            'PasswordOption' => 'required|string|in:auto,manual',
            'manualPassword' => 'nullable|string|min:6|max:255',
        ]);

        // Xử lý mật khẩu
        if ($request->PasswordOption === 'auto') {
            $password = Str::random(8); // Sinh mật khẩu tự động
        } else {
            $password = $request->manualPassword; // Lấy mật khẩu từ người dùng nhập
        }
        if ($request->hasFile('avt')) {
            $avatarPath = $request->file('avt')->store('/images/staff/', 'public');
        } else {
            $avatarPath = 'default-avatar.png'; // Đường dẫn ảnh mặc định
        }

        // Tạo mới user
        Users::create([
            'FullName' => $request->FullName,
            'Email' => $request->Email,
            'Password' => Hash::make($password), // Mã hóa mật khẩu trước khi lưu
            'avt' =>  $avatarPath,
            'Phone' => $request->Phone,
            'Address' => $request->Address,
            'RoleID' => $request->RoleID,
            'Status' => 1,
            'CreatedAt' => now(),
            'UpdatedAt' => now(),
            'Date_of_birth' => $request->Date_of_birth,
        ]);

        return redirect()->route('staff.index')->with('success', 'Thêm nhân viên thành công!');
    }


    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $user = Users::findOrFail($id);
        $roles = Role::all();
        return view('admin.staff.edit', compact('user', 'roles'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
            'avt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng ảnh
        ]);

        $user = Users::findOrFail($id);

        // Kiểm tra nếu có file ảnh mới được tải lên
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            // Tạo tên file mới tránh trùng lặp
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Xóa ảnh cũ nếu có
            if ($user->avt && File::exists(public_path('/images/staff/' . $user->avt))) {
                File::delete(public_path('/images/staff/' . $user->avt));
            }

            // Lưu ảnh vào thư mục public/images/staff/
            $avatar->move(public_path('/images/staff/'), $filename);

            // Cập nhật đường dẫn ảnh mới trong database
            $user->avt = $filename;
        }

        // Cập nhật thông tin nhân viên
        $user->FullName = $request->FullName;
        $user->Email = $request->Email;
        $user->Phone = $request->Phone;
        $user->Address = $request->Address;
        // Nếu có mật khẩu mới, mã hóa và cập nhật
        if ($request->filled('Password')) {
            $user->Password = Hash::make($request->Password);
        }
        $user->save();

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
