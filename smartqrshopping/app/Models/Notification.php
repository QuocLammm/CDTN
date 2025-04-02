<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'NotificationID';
    public $timestamps = false;

    protected $fillable = ['UserID', 'Message', 'CreatedAt'];

    public function user()
    {
        return $this->belongsTo(Users::class, 'UserID');
    }
}
