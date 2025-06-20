<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'role_id',
        'google_id',
        'full_name',
        'email',
        'password',
        'address',
        'phone',
        'account_name',
        'date_of_birth',
        'image',
        'gender',
        'status',
        'promo_code'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }
    public function hasRole($role) {
        return $this->role_name === $role;
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id'); // Mối quan hệ với bảng orders
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'user_id', 'user_id');
    }

}
