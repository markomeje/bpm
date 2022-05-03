<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    /**
     * Advert types.
     *
     * @var []
     */
    public static $status = [
        'expired', 
        'active',
        'paused',
        'initialized',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'started', 
        'credit_id',
        'description',
        'link',
        'expiry',
        'status', 
        'reference',
        'paused_at',
        'clicks',
    ];

    /**
     * Advert types.
     *
     * @var []
     */
    public static $sizes = [
        ['name' => 'Sidebar small banner', 'code' => 'ssb', 'width' => '100%', 'height' => '200px'],
        ['name' => 'Fullwidth horizontal banner', 'code' => 'fhb', 'width' => '100%', 'height' => '120px'],
        ['name' => 'Sidebar veritcal banner', 'code' => 'svb', 'width' => '100%', 'height' => '480px'],
    ];

    /**
     * An advert is posted with a particular credit unit
     */
    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }

    /**
     * An advert belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An advert may have one image
     */
    public function image()
    {
        return $this->hasOne(Image::class, 'model_id')->where([
            'type' => 'advert', 
            'user_id' => auth()->id()
        ]);
    }

}
