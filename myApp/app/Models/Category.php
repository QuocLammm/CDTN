<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $timestamp = true;
    protected $fillable = [
        'category_name',
        'description',
        'status',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
