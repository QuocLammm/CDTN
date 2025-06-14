<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = true;
    protected $fillable = [
        'supplier_id',
        'category_id',
        'product_name',
        'description',
        'qr_code_base64',
        'price',
        'status',
        'is_new',
        'is_sale',
        'sale_price',

    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id','supplier_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','product_id');
    }

    // Quan hệ với ProductReview
    public function reviews()
    {
        return $this->hasMany(ProductReview::class,'product_id','product_id');
    }



}
