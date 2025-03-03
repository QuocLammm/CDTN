<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $searchPerformed = !empty($search);  // Kiểm tra xem có thực hiện tìm kiếm hay không

        $categories = Category::where('CategoryName', 'LIKE', '%' . $search . '%')
            ->orWhere('Description', 'LIKE', '%' . $search . '%')
            ->get();

        $totalResults = $categories->count(); // Đếm số lượng kết quả tìm kiếm

        return view('admin.categories.index',
            compact('categories',
                'search',
                'searchPerformed',
                'totalResults'));
    }

    // Tạo mới loại sản phẩm
    public function create(){
        return view('admin.categories.create');
    }
    // Lưu trữ thôgn tin loại sản phẩm
    public function store(Request $request){

    }
    // Chỉnh sửa loại sản phẩm
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact("category"));
    }
    // Cập nhật loại sản phẩm
//    public function update(Request $request, $id){
//        $category = Category::findOfFail($id);
//
//    }
    // Xóa loại sản phẩm
    public function destroy($id){

    }
}
