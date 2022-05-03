<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company',
        'reference',
        'link',
        'phone',
        'user_id',
        'username',
    ];

    /**
     * The socail media companies
     *
     * @var string[]
     */
    public static $companies = [
        'facebook',
        'linkedin',
        'twitter',
        'instagram',
        'whatsapp',
        'youtube',
    ];
}
