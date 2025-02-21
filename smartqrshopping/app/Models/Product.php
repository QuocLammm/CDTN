<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'ProductID';
    public $timestamps = false;

    protected $fillable = ['ProductName', 'CategoryID', 'Price'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'ProductID');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'ProductID');
    }
}
