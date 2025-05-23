<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';
    protected $primaryKey = 'LogID';
    public $timestamps = false;

    protected $fillable = ['ProductID', 'QuantityChanged', 'ChangeType', 'ChangeDate'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
