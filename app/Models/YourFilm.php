<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class YourFilm
 *
 * @property integer $id_user
 * @property integer $id_film
 */
class YourFilm extends Model
{
    use HasFactory;

    protected $table = 'your_film';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_film'
    ];
}
