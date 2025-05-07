<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $fillable = [
        'cart_id',
        'product_detail_id',
        'quantity',
    ];

    // Mối quan hệ với bảng Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    // Mối quan hệ với bảng Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_detail_id','product_detail_id');
    }
}
