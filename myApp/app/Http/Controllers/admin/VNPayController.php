<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class VNPayController extends Controller
{
    public function showPaymentPage(Request $request)
    {
        $products = Product::all();

        // Nếu có tham số product_id thì truyền dữ liệu sản phẩm đó
        $selectedProduct = null;
        if ($request->has('ProductID')) {
            $selectedProduct = collect($products)->firstWhere('ProductID', $request->ProductID);
        }

        return view('admin.pay.vnpay_demo', compact('products', 'selectedProduct'));
    }


    public function createPayment(Request $request)
    {
        // Lấy thông tin từ env hoặc cấu hình
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return'); // Sử dụng route Laravel
        $vnp_TmnCode = env('VNPAY_TMN_CODE'); // Từ .env file
        $vnp_HashSecret = env('VNPAY_HASH_SECRET'); // Từ .env file

        $vnp_TxnRef = time(); // Mã giao dịch thời gian hiện tại
        $vnp_OrderInfo = 'Thanh toán đơn hàng'; // Thông tin đơn hàng
        $vnp_OrderType = 'billpayment'; // Loại thanh toán
        $vnp_Amount = $request->Price * 100; // Tiền cần thanh toán (VND)
        $vnp_Locale = 'vn'; // Ngôn ngữ
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của người dùng

        // Tạo dữ liệu gửi lên VNPay
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Sắp xếp dữ liệu theo thứ tự
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Tạo chữ ký bảo mật
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Chuyển hướng tới VNPay để thanh toán
        return redirect($vnp_Url);


    }

    public function returnPayment(Request $request)
    {
        // Lấy thông tin trả về từ VNPay sau khi thanh toán
        $vnp_ResponseCode = $request->vnp_ResponseCode;  // Mã trạng thái
        if ($vnp_ResponseCode == '00') {
            // Thanh toán thành công
            return redirect()->route('vnpay.success');  // Điều hướng đến trang thành công
        } else {
            // Thanh toán thất bại
            return redirect()->route('vnpay.failure');  // Điều hướng đến trang thất bại
        }
    }

    public function paymentSuccess()
    {
        return view('admin.pay.success');
    }

    public function paymentFailure()
    {
        return view('admin.pay.failure');
    }
}
