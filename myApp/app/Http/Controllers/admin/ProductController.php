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


    public function store(ProductRequest $request)
    {
        $data = $request->all();

        // Xử lý ảnh upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'product_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/images/products/'), $fileName);
            $data['image'] = '/images/products/' . $fileName;
        }

        // Tạo sản phẩm
        $product = Product::create($data);

        // Tạo mã QR (dưới dạng SVG base64)
        $qrContent = route('show-product.show', $product->product_id); // hoặc chỉ cần ID, tùy bạn
        $svg = QrCode::format('svg')->size(200)->generate($qrContent);
        $qrBase64 = base64_encode($svg);

        // Lưu QR vào DB
        $product->update(['qr_code_base64' => $qrBase64]);

        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã thêm kèm mã QR!');
    }



    public function edit(Product $product) {
        $suppliers = Supplier::pluck('supplier_name', 'supplier_id');
        $categories = Category::pluck('category_name', 'category_id');
        $product->load('productDetail');
        return view('admin.product.edit', compact('product', 'suppliers', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        // Xử lý ảnh
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $file = $request->file('image');
                $fileName = 'product_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/images/products/'), $fileName);
                $data['image'] = '/images/products/' . $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi khi tải lên hình ảnh: ' . $e->getMessage());
            }
        }

        // Cập nhật sản phẩm
        $product = Product::findOrFail($id);
        $product->update($data);

        // Lưu 3 trường trong ProductDetail
        $productDetailData = [
            'size' => $request->input('ProductDetail.size'),
            'color' => $request->input('ProductDetail.color'),
            'quantity' => $request->input('ProductDetail.quantity'),
        ];

        // Kiểm tra và tạo mới hoặc cập nhật ProductDetail
        if ($product->productDetail) {
            $product->productDetail->update($productDetailData);
        } else {
            $product->productDetail()->create($productDetailData);
        }

        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã cập nhật!');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã xóa!');
    }

}
