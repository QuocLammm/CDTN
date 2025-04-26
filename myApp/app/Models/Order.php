<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
        protected $table = 'orders';
        protected $primaryKey = 'order_id';
        public $timestamps = true;
        protected $fillable = [
            'user_id',
            'total_amount',
            'status',
        ];

        public function user(){
            return $this->belongsTo('user_id', 'user_id');
        }
}
