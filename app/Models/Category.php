<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
    ];

     /**
     * Category types
     *
     * @var string[]
     */
    public static $types = [
        'blog',
    ];

    /**
     * A category may have many blogs
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
