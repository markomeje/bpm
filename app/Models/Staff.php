<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'created_by',
        'description',
        'code',
        'type',
        'verified',
        'status',
        'role'
    ];

    /**
     * All staff status
     *
     * @var string[]
     */
    public static $status = [
        'active',
        'suspended',
        'banned',
        'disabled',
        'pending'
    ];

    /**
     * A staff belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
