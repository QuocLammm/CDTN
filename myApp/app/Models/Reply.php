<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $table = 'replies';
    public $timestamps = true;
    protected $fillable = [
        'contact_id', 'admin_name', 'reply_message', 'reply_date'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
