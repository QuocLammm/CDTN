<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\QrCodes;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $searchPerformed = !empty($search);

        $products = Product::where('ProductName', 'LIKE', '%' . $search . '%')
            ->orWhere('Description', 'LIKE', '%' . $search . '%')
            ->paginate(3); // Phân trang 3 sản phẩm 1 trang

        $totalResults = $products->total(); // Đếm tổng số kết quả

        return view('admin.products.index', compact('products', 'search', 'searchPerformed', 'totalResults'));
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

    //L
    public function edit($productid){
        $products = Product::findOrFail($productid);
        return view('admin.products.edit', compact('products'));
    }

    public function destroy($productid){

    }
}
