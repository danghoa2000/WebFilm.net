<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FilmReview
 *
 * @property integer $id_user
 * @property integer $id_film
 */
class FilmReview extends Model
{
    use HasFactory;

    protected $table = 'film_review';

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
