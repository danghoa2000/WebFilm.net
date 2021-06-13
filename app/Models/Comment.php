<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @property string $name
 * @property string $avatar
 * @property string $noi_dung
 * @property integer $id_film
 *
 */
class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'noi_dung',
        'id_film',
        'created_at',
        'updated_at'
    ];
}
