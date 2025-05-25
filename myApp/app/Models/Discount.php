<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $primaryKey = 'discount_id';
    public $timestamps = true;
    protected $fillable = [
        'discount_code',
        'description',
        'discount_amount',
        'start_date',
        'end_date',
        'status',
    ];

    // Quan hệ 1-n với discount_targets
    public function targets()
    {
        return $this->hasMany(DiscountTarget::class, 'discount_id', 'discount_id');
    }

}
