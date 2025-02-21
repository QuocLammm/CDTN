<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';
    protected $primaryKey = 'DiscountID';
    public $timestamps = false;

    protected $fillable = ['ProductID', 'DiscountPercentage', 'StartDate', 'EndDate'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}

