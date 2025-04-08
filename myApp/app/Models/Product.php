<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'ProductID';
    public $timestamps = true;
    protected $fillable = [
        'SupplierID',
        'CategoryID',
        'ProductName',
        'Description',
        'Image',
        'Price',
        'CreatedAt',
        'UpdatedAt',

    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID', 'SupplierID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }


}
