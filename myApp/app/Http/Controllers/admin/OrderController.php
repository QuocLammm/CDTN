<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function create(){
        return view('admin.order.create');
    }

    public function store(Request $request ){}
}
