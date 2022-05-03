<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'country_id',
        'state',
        'address',
        'name',
        'city',
        'currency_id',
        'amount',
        'user_id',
        'additional',
        'reference',
        'price',
    ];

    /**
     * Material status.
     *
     * @var string[]
     */
    public static $status = [
        'active', 
        'inactive', 
        'suspended',
        'audit', 
        'banned', 
        'rejected', 
    ];

    /**
     * A material belongs to a user who listed it.
     * An agent, realtor, company etc
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A material is listed in a particular country
     * Nigeria, US, Australia etc
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * A material is listed in a particular currency
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * A material may have many images
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'model_id')->where(['type' => 'material']);
    }

    /**
     * A material may have been promoted
     */ 
    public function promotion()
    {
        return $this->hasOne(Promotion::class, 'model_id')->where(['type' => 'material']);
    }

}
