<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * Reviews Status
     */
    public static $status = ['edited', 'verified'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'review',
        'profile_id', // The reviewed profile
        'status',
        'user_id', //The user that reviewed
    ];

    /**
     * A review was posted by a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A review belongs to a profile 
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
