<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function user_role()
    {
        return $this->belongsTo(Role::class, 'group');
    }

    public function u_region()
    {
        return $this->belongsTo(Region::class, 'region');
    }

    public function u_gender()
    {
        return $this->belongsTo(Gender::class, 'gender');
    }

    public function u_relationship()
    {
        return $this->belongsTo(Relationship::class, 'relationship');
    }

    public function userOffice()
    {
        return $this->hasOne(UserOffice::class);
    }
}
