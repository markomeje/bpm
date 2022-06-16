<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * Blog category description
     *
     * @var string
     */
    public static $categories = [
        'Business',
        'Real Estate',
        'Construction',
        'Surveying',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'user_id', 
        'published',  
        'category', 
        'description', 
        'views',
        'reference',
    ];

    /**
     * Blog published status
     */
    public static $publish = ['yes' => 1, 'no' => 0];

    /**
     * A blog may have an image
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'model_id')->where(['type' => 'blog']);
    }

    /**
     * Scope only published blogs
     */
    public function scopePublished($query)
    {
        return $query->where(['published' => true]);
    }
}
