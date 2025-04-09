<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
        protected $table = 'orders';
        protected $primaryKey = 'OrderID';
        public $timestamps = true;
        protected $fillable = [
            'UserID',
            'TotalAmount',
            'Status',
        ];

        public function user(){
            return $this->belongsTo('UserID', 'UserID');
        }
}
