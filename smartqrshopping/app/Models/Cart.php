<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'CartID';
    public $timestamps = false; // Nếu không sử dụng created_at, updated_at

    protected $fillable = ['UserID', 'CreatedAt'];

    public function user() {
        return $this->belongsTo(Users::class, 'UserID');
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class, 'CartID');
    }
}
