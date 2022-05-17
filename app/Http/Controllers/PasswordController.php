<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\{User, Password};


class PasswordController extends Controller
{
    /**
     * Process password reset view
     */
    public function index()
    {
        return view('frontend.password.index', ['title' => 'Process Reset Password | Best Property Market']);
    }

    public function verify($token = '')
    {   
        $verify = self::check($token);
        $expired = !Carbon::parse($verify['data']->created_at ?? null)->addMinutes($minutes = 1440)->gt(Carbon::now());
        return view('frontend.password.verify', ['title' => 'Password Reset | Best Property Market', 'token' => $verify['data']->token ?? null, 'expired' => $expired, 'user' => $verify['user'] ?? null]);
    }

    private static function check($token = '') {
        $reset = Password::where(['token' => $token])->latest()->first();
        return ['data' => $reset, 'user' => User::where(['email' => $reset->email ?? null])->first()];
    }

}
