<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'SaleID';
    protected $fillable = [
        'OrderID',
        'ProductID',
        'UserID',
        'Quantity',
        'Sale_Price',
        'Sale_Date'
    ];

    public function user(){
        return $this->belongsTo('UserID', 'UserID');
    }

    public function order(){
        return $this->belongsTo('OrderID', 'OrderID');
    }

    public function product(){
        return $this->belongsTo('ProductID', 'ProductID');
    }
}
