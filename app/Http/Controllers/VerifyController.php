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

    public static function otpverify($reference)
    {
        $data = request()->only(['code']);
        $validator = Validator::make($data, [ 
            'code' => ['required', 'min:6', 'max:6'],
        ], ['code.required' => 'Please enter the code.']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $verify = Verify::where([
            'otp' => $data['code'], 
            'reference' => $reference
        ])->latest()->get()->first();
        
        if (empty($verify)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid code.'
            ]);
        }

        if (Carbon::parse($verify->otpexpiry)->diffInMinutes(Carbon::now()) > 10) {
            return response()->json([
                'status' => 0,
                'info' => 'Expired code. Click resend code below.'
            ]);
        }

        $verify->otp = null;
        $verify->phoneactive = true;
        $verify->reference = null;
        $verify->update();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successfull',
            'redirect' => route('login'),
        ]);
    }

    /**
     * Resend otp Api
     */
    public static function resendotp($reference = '')
    {
        $verify = Verify::where(['reference' => $reference])->latest()->get()->first();
        if (empty($verify)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation.'
            ]);
        }

        $otp = random_int(100000, 999999);
        $verify->otpexpiry = Carbon::now()->addMinutes(10);
        $verify->phoneactive = false;
        $verify->otp = $otp;
        $verify->update();

        Sms::otp([
            'otp' => $otp, 
            'phone' => $verify->phone,
        ]);

        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => route('phone.verify', ['reference' => $reference]),
        ]);
    }

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

    public static function resendtoken($token = '')
    {
        $data = request()->only(['email']);
        $validator = Validator::make($data, [
            'email' => ['required'], 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $token = Str::random(64);
        $verify = Verify::where(['email' => $data['email']])->latest()->get()->first();
        if (empty($verify)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid operation.'
            ]);
        }

        try {
            $verify->token = $token;
            $verify->tokenexpiry = Carbon::now()->addMinutes(60);
            $verify->update();
            $mail = new EmailVerification([ 
                'email' => $data['email'],
                'token' => $token,
            ]);
    
            Mail::to($data['email'])->send($mail);
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful',
                'redirect' => route('token.resent'),
            ]);

        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'info' => 'Unknown Error. Try Again.'
            ]);
        }
    }

    /**
     * View to display successfull resent email verify token
     */
    public function resent()
    {  
        return view('frontend.verify.resent');
    }

}
