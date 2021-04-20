<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Film
 *
 * @property string $img
 * @property string $name
 * @property integer $IMDb
 * @property integer $so_danh_gia
 * @property integer $nam_sx
 * @property string $mota
 * @property integer $luot_xem
 * @property string $quoc_gia
 * @property string $link_trailer
 * @property boolean $flag_delete
 *
 */
class Film extends Model
{
    use HasFactory;

    protected $table = 'film';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'img',
        'img_background',
        'name',
        'IMDb',
        'so_danh_gia',
        'nam_sx',
        'mota',
        'luot_xem',
        'quoc_gia',
        'link_trailer',
        'flag_delete',
        'updated_at',
        'create_at'
    ];
}
