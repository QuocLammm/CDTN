<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewPage extends Model
{
    protected $table = 'views';
    protected $fillable = ['view_date', 'total_views'];

}
