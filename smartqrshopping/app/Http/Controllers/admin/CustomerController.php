<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Users::where('RoleID', 2)->get();
        return view('admin.customer.index', compact('customers'));
    }

    //Hiển thị form tạo mới
    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'FullName' => 'nullable|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Gender' => 'nullable|string|in:male,female,other',
            'RoleID' => 'required|integer|in:1,3',
            'PasswordOption' => 'required|string|in:auto,manual',
            'manualPassword' => 'nullable|string|min:6|max:255',
            'Phone' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
            'Date_of_Birth' => 'nullable|date',
            'avt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Chỉ chấp nhận ảnh
        ], [
            'Email.unique' => 'Email đã tồn tại',
        ]);

        // Xử lý mật khẩu
        $validatedData['Password'] = Hash::make(
            $request->PasswordOption === 'auto' ? Str::random(8) : $request->manualPassword
        );

        // Xử lý ảnh đại diện (nếu có)
        if ($request->hasFile('avt')) {
            $file = $request->file('avt');
            $filename = 'staff_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/images/staff'), $filename);
            $validatedData['avt'] = $filename;
        }

        // Thêm trạng thái mặc định
        $validatedData['Status'] = 1;

        // Lưu vào database
        try {
            Users::create($validatedData);
            return redirect()->route('staff.index')->with('success', 'Thêm nhân viên thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $customers = Users::findOrFail($id);
        return view('admin.customer.edit', compact('customers'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
            'avt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng ảnh
        ]);

        $customers = Users::findOrFail($id);

        // Kiểm tra nếu có file ảnh mới được tải lên
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            // Tạo tên file mới tránh trùng lặp
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            // Xóa ảnh cũ nếu có
            if ($customers->avt && File::exists(public_path('/images/customers/' . $customers->avt))) {
                File::delete(public_path('/images/customers/' . $customers->avt));
            }

            // Lưu ảnh vào thư mục public/images/staff/
            $avatar->move(public_path('/images/customers/'), $filename);

            // Cập nhật đường dẫn ảnh mới trong database
            $customers->avt = $filename;
        }

        // Cập nhật thông tin nhân viên
        $customers->FullName = $request->FullName;
        $customers->Email = $request->Email;
        $customers->Gender = $request->Gender;
        $customers->Phone = $request->Phone;
        $customers->Address = $request->Address;
        $customers->Date_of_Birth= $request->Date_of_Birth;
        // Nếu có mật khẩu mới, mã hóa và cập nhật
        if ($request->filled('Password')) {
            $customers->Password = Hash::make($request->Password);
        }
        $customers->save();

        return redirect()->route('customer.index')->with('success', 'Cập nhật thông tin khách hàng thành công!');
    }

    // Xóa khách hàng
    public function destroy($id)
    {
        $customers = Users::find($id);

        if (!$customers) {
            // Nếu không tìm thấy và request không phải AJAX thì chuyển hướng về trang index với thông báo lỗi
            if (!request()->ajax()) {
                return redirect()->route('customer.index')->with('error', 'Không tìm thấy khách hàng!');
            }
            return response()->json(['message' => 'Không tìm thấy khách hàng!'], 404);
        }

        $customers->delete();

        // Nếu request là AJAX, trả về JSON
        if (request()->ajax()) {
            return response()->json(['message' => 'Khách hàng đã được xóa!']);
        }

        // Nếu không phải AJAX, chuyển hướng về trang staff.index với flash message thành công
        return redirect()->route('customer.index')->with('success', 'Khách hàng đã được xóa thành công!');
    }
}
