<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'notification_id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'content',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
