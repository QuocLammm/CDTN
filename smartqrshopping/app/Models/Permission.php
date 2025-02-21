<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $primaryKey = 'PermissionID';
    public $timestamps = false;

    protected $fillable = ['PermissionName'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'PermissionID', 'RoleID');
    }
}
