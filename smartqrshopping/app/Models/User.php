<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    protected $fillable = ['Username', 'Password', 'Email', 'RoleID'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleID');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'UserID');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'UserID');
    }
}

