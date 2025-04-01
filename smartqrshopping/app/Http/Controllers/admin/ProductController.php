<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\QrCodes;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Lấy toàn bộ sản phẩm
        return view('admin.products.index', compact('products'));
    }

    //Tạo mã QR cho từng sản phẩm
    public function showQRCode($id)
    {
        $product = Product::findOrFail($id);
        $url = route('products.qr', $product->ProductID); // Lấy trang chi tiết sản phẩm ( trang khách hàng truy cập được)

        // Tạo mã QR và lưu vào base64
        $qrCodeImage = QrCode::size(200)->generate($url);
        $qrCodeBase64 = base64_encode($qrCodeImage);

        // Lưu vào cơ sở dữ liệu
        QrCodes::create([ // Giả sử bạn đã định nghĩa model là QrCodeModel
            'ProductID' => $product->ProductID,
            'qr_link' => $url,
            'qr_image_base64' => $qrCodeBase64,
        ]);

        return view('admin.products.qr', compact('product', 'url', 'qrCodeBase64'));
    }

    //Tạo mới sản phẩm
    public function create(){
        return view('admin.products.create');
    }

    //Lưu trữ thông tin sản phẩm
    public function store(){
        return view('admin.products.store');
    }

    //Hiển thị trang chỉnh sửa chi tiết sản phẩm
    public function edit($productid){
        $product = Product::findOrFail($productid);
        $productDetails = ProductDetail::where('ProductID', $productid)->get();
        return view('admin.products.edit', compact('product','productDetails'));
    }

    //Cập nhật chi tiết sản phẩm
    public function update(Request $request, $productid) {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'required|string',
            'Price' => 'required|numeric',
            'Sizes' => 'required|string',
            'Quantities' => 'required|string',
            'Color' => 'required|string',
        ]);

        $product = Product::findOrFail($productid);
        $productDetail = ProductDetail::where('ProductID', $productid)
            ->where('Color', $request->Color)
            ->firstOrFail();

        // Update product fields
        $product->ProductName = $request->ProductName;
        $product->Description = $request->Description;
        $product->Price = $request->Price;
        $product->Image = $request->Image;
        $product->save();

        // Update product detail fields
        $productDetail->Sizes = $request->Sizes;
        $productDetail->Quantities = $request->Quantities;
        $productDetail->save();

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    //Xóa thông tin sản phẩm
    public function destroy($productid){

    }


}
