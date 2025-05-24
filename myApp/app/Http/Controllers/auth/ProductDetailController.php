<?php

namespace App\Http\Controllers\auth;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductDetailController
{
    public function show($id)
    {
        $product = Product::with(['reviews.user'])->findOrFail($id);
        return view('homepages.auth.product_detail_item', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        ProductReview::create([
            'product_id' => $product->product_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi bình luận!');
    }


}
