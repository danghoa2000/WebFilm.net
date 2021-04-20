<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ViewsFromTimeToTime
 *
 * @property integer $role
 * @property integer $luot_xem
 * @property integer $id_film
 *
 */
class ViewsFromTimeToTime extends Model
{
    use HasFactory;

    protected $table = 'views_from_time_to_time';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'luot_xem',
        'id_film'
    ];
}
