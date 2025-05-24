<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'full_name', 'email', 'phone', 'subject', 'message', 'status', 'sent_date'
    ];

    public function getStatusText()
    {
        return match ($this->status) {
            'unread' => 'Chưa đọc',
            'read' => 'Đã đọc',
            default => ucfirst($this->status),
        };
    }


    public function replies()
    {
        return $this->hasMany(Reply::class, 'contact_id', 'id');
    }
}
