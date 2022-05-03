<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'model_id',
        'link',
        'type',
        'public_id',
        'role',
        'format',
        'user_id',
    ];

    /**
     * Images Types
     *
     * @var string[]
     */
    public static $types = [
        'property', 
        'blog', 
        'material', 
        'profile', 
        'advert', 
        'service',
    ];

    /**
     * Images dimentions
     *
     * @var string[]
     */
    public static $dimentions = [
        'material' => ['width' => 250, 'height' => 456], 
        'profile' => ['width' => 250, 'height' => 456], 
        'advert' => ['width' => 250, 'height' => 456], 
        'property' => ['width' => 960, 'height' => 1024], 
        'service' => ['width' => 250, 'height' => 456],
        'blog' => ['width' => 250, 'height' => 456],
    ];

}
