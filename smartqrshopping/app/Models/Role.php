<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'RoleID';
    public $timestamps = false;

    protected $fillable = ['RoleName','Description'];

    public function users()
    {
        return $this->hasMany(Users::class, 'RoleID');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'RoleID', 'PermissionID');
    }
}
