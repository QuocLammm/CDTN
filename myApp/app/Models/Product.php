<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = true;
    protected $fillable = [
        'supplier_id',
        'category_id',
        'product_name',
        'description',
        'qr_code_base64',
        'image',
        'price',

    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id','supplier_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id', 'product_id');
    }


}
