<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Hiển thị danh sách loại sản phẩm
    public function index() {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Tạo mới loại sản phẩm
    public function create(){
        return view('admin.categories.create');
    }
    // Lưu trữ thôgn tin loại sản phẩm
    public function store(Request $request){
        $category = new Category();
        $category->CategoryName = $request->input('CategoryName');
        $category->Description = $request->input('Description');
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Thêm loại sản phẩm thành công!');
    }
    // Chỉnh sửa loại sản phẩm
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact("category"));
    }
    // Cập nhật loại sản phẩm
    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->CategoryName = $request->input('CategoryName');
        $category->Description = $request->input('Description');
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Cập nhật loại sản phẩm thành công!');
    }
    // Xóa loại sản phẩm
    public function destroy($id){
        $category = Category::find($id);
        if (!$category) {
            if (!request()->ajax()) {
                return redirect()->route('categories.index')->with('error', 'Không tìm thấy loại sản phẩm!');
            }
            return response()->json(['message' => 'Không tìm thấy loại sản phẩm!'], 404);
        }
        $category->delete();
        if (request()->ajax()) {
            return response()->json(['message' => 'Loại sản phẩm đã được xóa!']);
        }
        return redirect()->route('categories.index')->with('success', 'Loại sản phẩm đã được xóa thành công!');
    }
}
