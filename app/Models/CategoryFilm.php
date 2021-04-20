<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryFilm
 *
 * @property integer $id_category
 * @property integer $id_film
 */
class CategoryFilm extends Model
{
    use HasFactory;

    protected $table = 'category_film';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_category',
        'id_film'
    ];
}
