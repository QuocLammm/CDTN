<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'SupplierID';
    public $timestamps = true;
    protected $fillable = [
        'SupplierName',
        'Phone',
        'ContactName',
        'Address',
        'Email',

    ];
}
