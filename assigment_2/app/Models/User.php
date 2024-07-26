<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'username'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function hasRole($roleName)
    {
        return $this->role()->where('name', $roleName)->exists();
    }
   
    public function userDetails()
    {
        return $this->hasOne(UserDetails::class);
    }
    public function replies()
{
    return $this->hasMany(Reply::class);
}
    
}
