<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Verify, User};
use Illuminate\Support\Str;
use App\Mail\EmailVerification;
use App\Helpers\{Sms};
use Validator;
use Mail;
use Carbon\Carbon;

class VerifyController extends Controller
{
    /**
     * View to enter phone otp
     */
    public function phone($reference = '')
    {  
        return view('frontend.verify.phone')->with(['reference' => $reference]);
    }

    /**
     * Verify email
     */
    public static function verifyemail(string $token)
    {
        $verify = Verify::where(['token' => $token])->latest()->get()->first();
        if (empty($verify)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid email verification link.'
            ]);
        }

        if (Carbon::parse($verify->tokenexpiry)->diffInMinutes(Carbon::now()) > 60) {
            return response()->json([
                'status' => 0,
                'info' => 'Link expired. Click resend link below.'
            ]);
        }

        if ($verify->emailactive === true && empty($verify->token)) {
            return response()->json([
                'status' => 1,
                'info' => 'Email already verified.'
            ]);
        }

        $verify->token = null;
        $verify->emailactive = true;
        $verify->update();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successfull',
            'redirect' => route('login'),
        ]);
    }

    /**
     * View for verifying email link
     */
    public function email($token = '')
    {
        return view('frontend.verify.email')->with(['verify' => self::verifyemail($token), 'token' => $token]);
    }

    /**
     * View to display successfull resent email verify token
     */
    public function resent()
    {  
        return view('frontend.verify.resent');
    }

}
