<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    public $timestamps = true;
    protected $fillable = [
        'order_id',
        'product_detail_id',
        'quantity',
        'price',
    ];

    // Mối quan hệ với mô hình Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Mối quan hệ với mô hình Product (nếu
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_detail_id');
    }
}
