<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';
    protected $primaryKey = 'DetailID';
    public $timestamps = false;

    protected $fillable = ['ProductID', 'Description', 'Specification', 'Manufacturer'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
