<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index(){
        $users = User::whereIn('RoleID', [1,3])->get();
        return view('admin.staff.index', compact('users'));
    }

    public function create(){
        $roles = Role::whereIn('RoleID', [1, 3])
            ->pluck('RoleName', 'RoleID')
            ->toArray();
        $users = [
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

        return view('admin.staff.create', compact('roles', 'users', 'password'));
    }

    public function store(UserRequest $request){

        $data = $request->all();
        $data['RoleID'] = $request->input('RoleID');
        $data['Password'] = bcrypt($data['Password']);
        $data['Gender'] = $data['Gender'] === 'Female' ? 1 : 0;

        if ($request->hasFile('Image') && $request->file('Image')->isValid()) {
            $file = $request->file('Image');
            $fileName = 'staff_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Try to move the file and check if it's successful
            $destinationPath = public_path('/img/staff/');
            $file->move($destinationPath, $fileName);

            // Check if the file exists after moving
            if (file_exists($destinationPath . $fileName)) {
                $data['Image'] = '/img/staff/' . $fileName;
            } else {
                return back()->withErrors('Không thể lưu ảnh. Vui lòng thử lại.');
            }
        } else {
            return back()->withErrors('Có lỗi khi tải lên ảnh.');
        }

        User::create($data);
        return redirect()->route('show-staff.index')->with('success', 'Thêm nhân viên thành công!');
    }


    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::whereIn('RoleID', [1, 3])
            ->pluck('RoleName', 'RoleID')
            ->toArray();
        $users = [
            0 => 'Nam',
            1=> 'Nữ',
        ];

        return view('admin.staff.edit', compact('user', 'roles', 'users'));
    }

    public function update(Request $request, $id){
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
        $user = User::findOrFail($id);
        $user->update($data);
        return redirect()->route('show-staff.index')->with('success', 'Cập nhật nhân viên thành công!');
    }


    public function destroy(User $user){
        $user->delete();
        return redirect()->route('show-staff.index')->with('success', 'Xóa nhân viên thành công!');
    }
}
