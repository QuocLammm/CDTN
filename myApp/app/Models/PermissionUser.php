<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{

    protected $table = 'permission_user';

    public $timestamps = false;

    // Khai báo các mối quan hệ
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
