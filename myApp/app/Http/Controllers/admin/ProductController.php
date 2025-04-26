<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create() {

        $suppliers = Supplier::pluck('SupplierName', 'SupplierID');
        $categories = Category::pluck('CategoryName', 'CategoryID');

        return view('admin.product.create', compact('suppliers', 'categories'));
    }


    public function store(ProductRequest $request) {
        $data = $request->all();
        //Xử lý ảnh
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');

            // Tạo tên file mới
            $fileName = 'product_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Đường dẫn lưu file
            $file->move(public_path('/img/products/'), $fileName);

            // Lưu đường dẫn vào database
            $data['Image'] = '/img/products/' . $fileName;
        }

        Product::create($data);
        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã thêm!');
    }

    public function edit(Product $product) {
        $suppliers = Supplier::pluck('SupplierName', 'SupplierID');
        $categories = Category::pluck('CategoryName', 'CategoryID');
        $product->load('productDetail');
        return view('admin.product.edit', compact('product', 'suppliers', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->all();

        if ($request->hasFile('Image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($product->Image && file_exists(public_path($product->Image))) {
                unlink(public_path($product->Image));
            }

            $file = $request->file('Image');
            $fileName = 'update_' . time() . '_' . $file->getClientOriginalName();
            $path = '/img/products/';

            // Di chuyển file vào thư mục
            $file->move(public_path($path), $fileName);

            // Gán đường dẫn vào DB
            $data['Image'] = $path . $fileName;
        }

        $product->update($data);
        if ($product->productDetail) {
            $product->productDetail->update($request->input('ProductDetail'));
        } else {
            $product->productDetail()->create($request->input('ProductDetail'));
        }
        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã cập nhật!');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã xóa!');
    }
}
