<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Product types.
     *
     * @var []
     */
    public static $categories = [
        'material' => 'Building Materials',
    ],

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name', 
        'image', 
        'status',
        'category', 
        'quantity', 
        'description',
        'price',
        'reference',
    ];

}
