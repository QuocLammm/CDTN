<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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

    public function store(CategoryRequest $request){
        Category::create($request->validated());
        return redirect()->route('show-category.index')->with('success', 'Loại sản phẩm đã thêm!');
    }

    public function edit($id){
        $categories = Category::FindOrFail($id);
        $products = Product::where('category_id', $id)->get();
        return view('admin.category.edit', compact('categories','products'));
    }

    public function update(Request $request, $categoryId)
    {
        // 1. Cập nhật Category
        $category = Category::findOrFail($categoryId);
        $category->update([
            'category_name' => $request->input('category_name'),
            'description' => $request->input('description'),
        ]);


        return redirect()->route('show-category.index')->with('success', 'Danh mục sản phẩm đã cập nhật!');
    }



    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('show-category.index')->with('success','Loại sản phẩm đã được xóa thành công');
    }
}
