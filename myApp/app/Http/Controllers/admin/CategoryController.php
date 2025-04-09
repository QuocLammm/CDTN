<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request){
        $data = $request->all();
        Category::create($data);
        return redirect()->route('show-category.index')->with('success', 'Loại sản phẩm đã thêm!');
    }

    public function edit(Category $category){
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category){
        $data = $request->all();
        $category->update($data);
        return redirect()->route('show-category.index')->with('success','Cập nhật loại sản phẩm thành công!');
    }

    public function destroy(Category $category){
        $category->delete();
        return view('show-category.index')->with('success','Loại sản phẩm đã được xóa thành công');
    }
}
