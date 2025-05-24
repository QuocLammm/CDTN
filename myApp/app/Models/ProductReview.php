<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $table = 'product_reviews';
    public $timestamps = true;
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }
}
