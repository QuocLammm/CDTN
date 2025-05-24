<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Models\ProductQrCode;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
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

        // Tìm sản phẩm theo tên
        $product = Product::where('product_name', $data['product_name'])->first();

        if (!$product) {
            // Nếu chưa có thì tạo mới sản phẩm
            $product = Product::create($data);

            // Tạo mã QR
            $qrContent = route('product.show', $product->product_id);
            $svg = QrCode::format('svg')->size(200)->generate($qrContent);
            $qrBase64 = base64_encode($svg);

            ProductQRCode::create([
                'product_id'    => $product->product_id,
                'qr_data'       => $qrContent,
                'qr_image_path' => $qrBase64,
            ]);
        }

        // Tạo chi tiết sản phẩm (mỗi loại size/color là một dòng riêng)
        ProductDetail::create([
            'product_id' => $product->product_id,
            'size'       => $data['size'],
            'color'      => $data['color'],
            'quantity'   => $data['quantity'],
        ]);

        // Nếu có ảnh thì tiếp tục xử lý ảnh
        if ($request->hasFile('images')) {
            $folderName = 'sp' . $product->product_id;
            $uploadPath = public_path('images/products/' . $folderName);

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                $imageName = 'product_extra_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move($uploadPath, $imageName);

                $imagePath = '/images/products/' . $folderName . '/' . $imageName;

                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã được cập nhật/thêm chi tiết!');
    }



    public function edit(Product $product) {
        $suppliers = Supplier::pluck('supplier_name', 'supplier_id');
        $categories = Category::pluck('category_name', 'category_id');
        $product->load('productDetails');
        return view('admin.product.edit', compact('product', 'suppliers', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('ProductDetail');
        $product = Product::findOrFail($id);
        $product->update($data);


//        $detailIdsInForm = collect($request->input('ProductDetails'))->pluck('product_detail_id')->filter()->all();
//
//        $product->productDetails()
//            ->whereNotIn('product_detail_id', $detailIdsInForm)
//            ->delete();

        // Duyệt và cập nhật các ProductDetail
        foreach ($request->input('ProductDetails', []) as $detailData) {
            if (isset($detailData['product_detail_id'])) {
                // Đã tồn tại: cập nhật
                $productDetail = ProductDetail::find($detailData['product_detail_id']);
                if ($productDetail) {
                    $productDetail->update($detailData);
                }
            } else {
                $product->productDetails()->create($detailData);
            }
        }

        // Xử lý ảnh
        $folderName = 'sp' . $product->product_id;
        $uploadPath = public_path('images/products/' . $folderName);

        // Nếu thư mục chưa tồn tại thì tạo
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Xử lý ảnh nếu có
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'product_extra_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move($uploadPath, $imageName);

                $imagePath = '/images/products/' . $folderName . '/' . $imageName;

                // Kiểm tra đường dẫn ảnh
                Log::info('Image Path: ' . $imagePath);

                // Lưu ảnh vào cơ sở dữ liệu
                ProductImage::create([
                    'product_id' => $product->product_id,
                    'image_path' => $imagePath,
                ]);

                // Kiểm tra xem ảnh đã lưu vào database chưa
                Log::info('Product Image Saved: ', [ $imagePath ]);
            }
        }

        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã cập nhật!');
    }


    public function destroy(Product $product)
    {
        // Xóa chi tiết sản phẩm
        $product->productDetails()->delete();
        // Xóa sản phẩm
        $product->delete();
        return redirect()->route('show-product.index')->with('success', 'Sản phẩm đã được xóa!');
    }

    public function getQrCode($productId)
    {
        $qr = ProductQRCode::where('product_id', $productId)->first();

        if (!$qr) {
            return response()->json(['error' => 'Không tìm thấy mã QR'], 404);
        }

        return response()->json([
            'qr_image_path' => $qr->qr_image_path,
        ]);
    }

    // API search ở homepage
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::where('product_name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->paginate(10);

        return view('homepages.auth.search_product', compact('products', 'keyword'));
    }

    public function destroyImage($id){
        $image = ProductImage::findOrFail($id);

        // Xoá file ảnh nếu tồn tại
        $imagePath = public_path($image->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $image->delete();

        return response()->json(['message' => 'Ảnh đã xoá']);
    }


}
