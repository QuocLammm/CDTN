<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountTarget extends Model
{
    use HasFactory;

    protected $table = 'discount_targets';
    public $timestamps = true;

    protected $fillable = [
        'discount_id',
        'target_type',
        'target_id',
    ];

    // Quan hệ ngược lại với Discount
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'discount_id');
    }
}
