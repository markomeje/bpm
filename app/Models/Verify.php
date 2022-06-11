<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory;

    /**
     * Overriding Eloquent table verifies
     */
    protected $table = 'verify';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'otpexpiry',
        'tokenexpiry',
        'otp',
        'token',
        'emailactive',
        'phoneactive',
        'reference',
        'phone',
        'email',
    ];

    public static function scopePhone($query, $phone)
    {
        $verify = $query->where(['phone' => $phone])->first();
        return empty($verify) ? false : $verify->phoneactive;
    }

    public static function scopeEmail($query, $email)
    {
        $verify = $query->where(['email' => $email])->first();
        return empty($verify) ? false : $verify->emailactive;
    }
}
