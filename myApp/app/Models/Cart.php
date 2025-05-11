<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = [
        'user_id',
    ];

    // Mối quan hệ với bảng CartItem
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }


    // Mối quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }

}
