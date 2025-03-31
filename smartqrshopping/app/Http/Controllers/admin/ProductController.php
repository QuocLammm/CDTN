<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\QrCodes;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function getData(Request $request)
    {
        $query = Product::query();

        // Nếu có tìm kiếm
        if ($search = $request->get('search')['value']) {
            $query->where('ProductName', 'LIKE', '%' . $search . '%')
                ->orWhere('Description', 'LIKE', '%' . $search . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn() // Thêm số thứ tự
            ->addColumn('action', function($row) {
                return '
                <form action="' . route('products.destroy', $row->ProductID) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" class="delete-button" onclick="showDeleteModal(event, this)">Xóa</button>
                </form>
                <form action="' . route('products.edit', $row->ProductID) . '" method="GET" style="display:inline;">
                    <button type="submit" class="edit-button">Sửa</button>
                </form>
            ';
            })
            ->make(true);
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
//        $request->validate([
//            'ProductName' => 'required|string|max:255',
//            'description' => 'required|string',
//            'price' => 'required|numeric',
//            'quantity' => 'required|integer',
//        ]);

        $product = Product::findOrFail($productid);
        $productDetails = ProductDetail::where('ProductID', $productid)->firstOrFail();

        //Cập nhật các trường trong Product
        $product->ProductName = $request->ProductName;
        $product->Description = $request->Description;
        $product->Price = $request->Price;
        $product->Image = $request->Image;
        $product->save();

        //Cập nhâjt các trường chi tiết Product
        $productDetails->Size = $request->Size;
        $productDetails->Color = $request->Color;
        $productDetails->Quantity = $request->Quantity;
        $productDetails->save();

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    public function destroy($productid){

    }
}
