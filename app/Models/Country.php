<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'region',
        'name',
        'capital',
        'phonecode',
        'iso3',
        'iso2',
    ];

    /**
     * A country may have many properties
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * A country belongs to a continent
     */
    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

}
