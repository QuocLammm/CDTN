<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create() {
        return view('admin.product.create');
    }

    public function store(Request $request) {
        Product::create($request->validate(['ProductName' => 'required', 'Price' => 'required|numeric']));
        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã thêm!');
    }

    public function edit(Product $product) {
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $product->update($request->validate(['ProductName' => 'required', 'Price' => 'required|numeric']));
        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã cập nhật!');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã xóa!');
    }
}
