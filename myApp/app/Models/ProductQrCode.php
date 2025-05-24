<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ProductQrCode extends Model
{
    use LogsActivity;

    protected $table = 'product_qrcodes';
    protected $fillable = ['product_id', 'qr_data', 'qr_image_path'];
    public $timestamps = true;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
