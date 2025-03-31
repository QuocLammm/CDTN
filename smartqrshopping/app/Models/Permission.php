<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $primaryKey = 'PermissionID';
    public $timestamps = false;

    protected $fillable = ['PermissionName','Description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'PermissionID', 'RoleID');
    }
}
