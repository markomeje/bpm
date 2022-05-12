<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'price',
        'reference',
        'status',
        'duration',
        'units',
        'currency_id'
    ];

    /**
     * All Unit status
     *
     * @var string
     */
    public static $status = [
        'active',  
        'cancelled', 
        'error',
    ];

    /**
     * Many user may buy same unit
     */
    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    /**
     * A unit belongs to a currency
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
