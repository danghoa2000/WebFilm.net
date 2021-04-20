<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * Class User
 *
 * @property string $email
 * @property string $user_name
 * @property string $password
 * @property string $name
 * @property date $birthday
 * @property string $avatar
 * @property boolean $status
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;

    protected $table = 'user';
    protected $guarded = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'user_name',
        'password',
        'name',
        'birthday',
        'avatar',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
