<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function showWishList()
    {
        $userId = Auth::id();
        $wishList = WishList::where('user_id', $userId)->get();
        return view('homepages.auth.wishlist', compact('userId', 'wishList'));
    }

    public function remove($id)
    {
        $wishItem = WishList::findOrFail($id);
        if ($wishItem->user_id === Auth::id()) {
            $wishItem->delete();
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi danh sách yêu thích.');
    }

}
