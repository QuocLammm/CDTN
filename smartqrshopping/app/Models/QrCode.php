<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    // Định nghĩa các trường có thể được gán hàng loạt
    protected $fillable = [
        'ProductID',
        'qr_link',
        'qr_image_base64',
        'created_at',
    ];

    // Nếu bạn cần định nghĩa quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
