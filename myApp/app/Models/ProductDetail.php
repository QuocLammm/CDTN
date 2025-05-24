<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'product_details';
    protected $primaryKey = 'product_detail_id';

    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
