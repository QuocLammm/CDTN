<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
        'status',
        'discount_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','user_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

}
