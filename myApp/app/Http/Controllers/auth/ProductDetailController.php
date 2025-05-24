<?php

namespace App\Http\Controllers\auth;

use App\Models\Product;

class ProductDetailController
{
    public function show($id)
    {
        $product = Product::with(['reviews.user'])->findOrFail($id);
        return view('homepages.auth.product_detail_item', compact('product'));
    }


}
