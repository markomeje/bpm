<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * Property actions.
     *
     * @var string[]
     */
    public static $actions = [
        'sale' => 'for sale', 
        'rent' => 'for rent', 
        'auction' => 'for auction',
        'lease' => 'for lease', 
        'sold' => 'sold off',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'country_id',
        'state',
        'address',
        'currency_id',
        'city',
        'listed',
        'action',
        'category',
        'measurement',
        'user_id',
        'additional',
        'reference',
        'price',
        'group',
        'status',
    ];

    /**
     * Property conditions.
     *
     * @var string[]
     */
    public static $conditions = [
        'furnished',  
        'new',
        'Renovated',
        'old', 
    ];

    /**
     * Property category description
     *
     * @var string
     */
    public static $categories = [
        'land' => [
            'name' => 'Landed Property', 
            'groups' => [
                'Empty Land',
                'Fenced Land',
            ],
        ],

        'commercial' => [
            'name' => 'Commercial Property', 
            'groups' => [
                'Shop',
                'Warehouse',
                'Event center',
            ],
        ],

        'industrial' => [
            'name' => 'Industrial Property', 
            'groups' => [
                'Filling Station',
            ],
        ],

        'residential' => [
            'name' => 'Residential Building', 
            'groups' => [
                'Duplex',
                'Flat',
                'One Room',
                'Semi-Detached Duplex',
                'Bungalow',
                'Self-Contain',
                'Terrace',
            ],
        ],
    ];

    /**
     * Property status.
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
     * Listed status.
     *
     * @var string[]
     */
    public static $listed = ['yes', 'no'];

    /**
     * Scope only active properties
     */
    public function scopeActive($query)
    {
        return $query->where(['status' => 'active']);
    }

    /**
     * A property belongs to a user who listed it.
     * An agent, realtor, company etc
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A property belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A property is listed in a particular country
     * Nigeria, US, Australia etc
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * A property is listed in a particular currency
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * A residential property has a house type
     */
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    /**
     * A property may have many images
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'model_id')->where(['type' => 'property']);
    }

    /**
     * A property may have been promoted
     */ 
    public function promotion()
    {
        return $this->hasOne(Promotion::class, 'model_id')->where(['type' => 'property']);
    }
    
}
