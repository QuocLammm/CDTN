<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create() {

        $suppliers = Supplier::pluck('supplier_name', 'supplier_id');
        $categories = Category::pluck('category_name', 'category_id');

        return view('admin.product.create', compact('suppliers', 'categories'));
    }


    public function store(ProductRequest $request) {
        $data = $request->all();

        // Xử lý ảnh
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $fileName = 'product_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/products/'), $fileName);
            $data['Image'] = '/img/products/' . $fileName;
        }

        // Tạo sản phẩm trước để lấy ID
        $product = Product::create($data);

        // Tạo mã QR chứa ID hoặc URL của sản phẩm
        $qrContent = route('show-product.show', $product->product_id);

        // Tạo file QR
        $qrFileName = 'qr_' . $product->id . '.png';
        $qrPath = public_path('/img/qrcodes/' . $qrFileName);

        // Tạo thư mục nếu chưa có
        File::ensureDirectoryExists(public_path('/img/qrcodes/'));

        // Lưu file QR
        QrCode::format('png')->size(200)->generate($qrContent, $qrPath);

        // Cập nhật đường dẫn QR vào DB
        $product->update(['qr_code' => '/img/qrcodes/' . $qrFileName]);

        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã thêm kèm mã QR!');
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
