<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Episode
 *
 * @property integer $id_film
 * @property string $link
 * @property integer $tap_so
 */
class Episode extends Model
{
    use HasFactory;

    protected $table = 'episode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_film',
        'link',
        'tap_so',
        'updated_at',
        'created_at'
    ];
}
