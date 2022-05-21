<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'content',
        'title',
        'user_id',
        'section',
        'page',
        'status',
        'part',
    ];

    /**
     * The content pages
     *
     * @var string[]
     */
    public static $pages = [
        'home',
        'about',
        'services',
        'blog',
        'properties',
        'status',
    ];

    /**
     * The content status
     *
     * @var string[]
     */
    public static $status = [
        'active',
        'inactive',
    ];
}
