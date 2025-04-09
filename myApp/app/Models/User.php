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
    protected $primaryKey = 'UserID';
    protected $fillable = [
        'RoleID',
        'FullName',
        'Email',
        'Password',
        'Address',
        'Phone',
        'AccountName',
        'Date_of_Birth',
        'Image',
        'Gender',
        'Status'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleID', 'RoleID');
    }

}
