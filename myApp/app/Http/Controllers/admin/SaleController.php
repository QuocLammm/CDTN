<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::all();
        return view ('admin.sale.index', compact('sales'));
    }
}
