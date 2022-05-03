<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'payment_id',
        'reference',
        'status',
        'started',
        'duration',
        'user_id',
        'expiry',
        'membership_id',
        'renewals',
        'amount',
        'currency_id'
    ];

    /**
     * All Subscription status
     *
     * @var string[]
     */
    public static $status = [
        'active', 
        'cancelled',  
        'expired',
        'renewed',
    ];

    /**
     * A subscription belongs to a user.
     * An agent, realtor, company etc
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A subscription belongs to a memberhip plan
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
