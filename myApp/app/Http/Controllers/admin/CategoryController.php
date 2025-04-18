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
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }

    public function store(){
        Category::create();
        return redirect()->route('show-category.index')->with('success', 'Loại sản phẩm đã thêm!');
    }

    public function edit(Category $category){
        return view('admin.category.edit', compact('category'));
    }

    public function update(Category $category){
        $category->update();
        return redirect()->route('show-category.index')->with('success','Cập nhật loại sản phẩm thành công!');
    }

    public function destroy(Category $category){
        $category->delete();
        return view('show-category.index')->with('success','Loại sản phẩm đã được xóa thành công');
    }
}
