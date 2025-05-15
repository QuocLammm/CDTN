<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->get(); // Lấy đơn hàng cùng với các sản phẩm
        return view('admin.order.index', compact('orders'));
    }

    public function create(){
        return view('show-order.create');
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('show-order.show', compact('order')); // Đảm bảo đường dẫn đúng
    }

    public function store(Request $request ){}
}
