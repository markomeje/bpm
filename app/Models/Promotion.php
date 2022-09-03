<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'credit_id',
        'duration',
        'started',
        'expiry',
        'promoted',
        'status',
        'user_id',
        'type',
        'reference',
        'model_id',
    ];

    /**
     * Promotion types
     *
     * @var string[]
     */
    public static $types = [
        'property',
        'profile',
        'material',
    ];

    /**
     * Promotion status
     *
     * @var string[]
     */
    public static $status = ['active', 'inactive', 'expired'];

    /**
     * Scope only active promotions
     */
    public function scopeActive($query)
    {
        return $query->where(['status' => 'active']);
    }

    /**
     * A promotion may belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A credit may belong to a property listed
     */
    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }

    /**
     * Promotion may have many Properties
     */ 
    public function properties()
    {
        return $this->hasMany(Property::class, 'model_id')->where(['type' => 'property']);
    }
}
