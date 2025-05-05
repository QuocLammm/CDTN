<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQrCode extends Model
{
    protected $fillable = ['product_id', 'qr_data', 'qr_image_path'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
