<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'price',
        'payment_id',
        'reference',
        'unit_id',
        'status',
        'duration',
        'units',
        'duration',
        'user_id',
    ];

    /**
     * Credit status.
     *
     * @var string[]
     */
    public static $status = [
        'running', 
        'inuse', 
        'expired',
        'paused',
        'used',
        'active',
    ];

    /**
     * Credit has one promotion
     */
    public function promotion()
    {
        return $this->hasOne(Promotion::class);
    }

    /**
     * Credit belongs to a unit
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
