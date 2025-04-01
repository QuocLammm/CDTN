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
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //Hiển thị ở trang
    public function index()
    {
        $users = Users::whereIn('RoleID', [1, 3])->get();
        return view('admin.staff.index', compact('users'));
    }

    //Hiển thị form tạo mới
    public function create()
    {
        $roles = Role::all(); // Fetch all roles from the database
        $users = Users::all();
        return view('admin.staff.create', compact('roles', 'users'));
    }
    //Lưu thông tin
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'Email' => 'required|email|unique:homepages,Email',
            'RoleID' => 'required|integer|in:1,3',
            'PasswordOption' => 'required|string|in:auto,manual',
            'manualPassword' => 'nullable|string|min:6|max:255',
        ],[
            'Email.unique' => 'Email đã tồn tại', // Thông báo lỗi nếu email đã có trong cơ sở dữ liệu
        ]);

        // Xử lý mật khẩu
        $password = $request->PasswordOption === 'auto'
            ? Str::random(8)
            : $request->manualPassword;

        // Xử lý lưu ảnh đại diện
        $profileImageName = null; // Khởi tạo biến lưu tên ảnh
        if ($request->hasFile('avt')) { // Kiểm tra xem có file ảnh không
            $file = $request->file('avt'); // Lấy file ảnh
            $profileImageName = 'staff_' . time() . '.' . $file->getClientOriginalExtension(); // Tạo tên file ảnh
            $file->move(public_path('/images/staff'), $profileImageName); // Di chuyển file đến thư mục lưu trữ
        }
        // Tạo mới user
        $user = new Users();
        $user->FullName = $request['FullName'] ?? null; // Lưu họ và tên
        $user->Email = $request['Email'] ?? null; // Lưu email
        $user->Gender = $request['Gender'] ?? null; // Lưu email
        $user->Password = Hash::make($password); // Mã hóa mật khẩu
        $user->avt = $profileImageName; // Lưu đường dẫn ảnh đại diện
        $user->Phone = $request['Phone'] ?? null; // Lưu số điện thoại
        $user->Address = $request['Address'] ?? null; // Lưu địa chỉ
        $user->RoleID = $request['RoleID']; // Lưu RoleID
        $user->Status = 1; // Trạng thái mặc định (có thể thay đổi nếu cần)
        $user->CreatedAt = now(); // Thời gian tạo
        $user->UpdatedAt = now(); // Thời gian cập nhật
        $user->Date_of_Birth = $request['Date_of_Birth']; // Lưu ngày sinh
        try {
            $user->save();
            return redirect()->route('staff.index')->with('success', 'Thêm nhân viên thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $users = Users::findOrFail($id);
        $roles = Role::all();
        return view('admin.staff.edit', compact('users', 'roles'));
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
        $user->Gender = $request->Gender;
        $user->Phone = $request->Phone;
        $user->Address = $request->Address;
        $user->Date_of_Birth= $request->Date_of_Birth;
        // Nếu có mật khẩu mới, mã hóa và cập nhật
        if ($request->filled('Password')) {
            $user->Password = Hash::make($request->Password);
        }
        $user->save();

        return redirect()->route('staff.index')->with('success', 'Cập nhật thông tin nhân viên thành công!');
    }

    // Xóa khách hàng
    public function destroy($id)
    {
        $user = Users::find($id);

        if (!$user) {
            // Nếu không tìm thấy và request không phải AJAX thì chuyển hướng về trang index với thông báo lỗi
            if (!request()->ajax()) {
                return redirect()->route('staff.index')->with('error', 'Không tìm thấy nhân viên!');
            }
            return response()->json(['message' => 'Không tìm thấy nhân viên!'], 404);
        }

        $user->delete();

        // Nếu request là AJAX, trả về JSON
        if (request()->ajax()) {
            return response()->json(['message' => 'Nhân viên đã được xóa!']);
        }

        // Nếu không phải AJAX, chuyển hướng về trang staff.index với flash message thành công
        return redirect()->route('staff.index')->with('success', 'Nhân viên đã được xóa thành công!');
    }



    //Kiểm tra mail là duy nhất
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = Users::where('email', $email)->exists(); // Adjust this according to your User model

        return response()->json(['exists' => $exists]);
    }
}
