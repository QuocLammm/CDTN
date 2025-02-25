<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $users = User::paginate(3); // Hiển thị 3 khách hàng mỗi trang
        return view('admin.customer.index', compact('users'));
    }

    public function create(){
        return view('admin.customer.create');
    }
}
