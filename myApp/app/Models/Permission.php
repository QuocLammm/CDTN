<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions'; // tên bảng

    protected $primaryKey = 'permission_id'; // khóa chính

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'permission_name',
        'description',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'permission_user', 'permission_id', 'user_id');
    }

}
