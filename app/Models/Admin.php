<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Admin
 *
 * @property string $email
 * @property string $user_name
 * @property string $password
 * @property string $name
 * @property date $birthday
 * @property string $avatar
 * @property boolean $status
 *
 */
class Admin extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $table = 'admin';
    protected $guarded = 'admin';

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
}
