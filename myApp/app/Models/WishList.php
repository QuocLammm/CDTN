<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'wishlist_id';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
}
