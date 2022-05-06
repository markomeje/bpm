<?php 

namespace App\Http\Controllers\Api;
use App\Mail\{EmailVerification, OtpLink};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\{User, Verify};
use App\Helpers\Sms;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Hash;
use Mail;
use Exception;


/**
 * 
 */
class AuthController extends Controller
{

	/**
     * @param $request
     * 
     * @return json
     */
    public function signup()
    {
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'email' => ['nullable', 'email', 'unique:users'], 
            'phone' => ['required', 'unique:users'], 
            'password' => ['required', 'string'],
            'retype' => ['required', 'same:password'],
            'agree' => ['required', 'string'],
        ], ['retype.required' => 'Please enter a password', 'agree.required' => 'You have to agree to our terms and conditions', 'phone.required' => 'Please enter your phone number.', 'retype.same:password' => 'Retype thesame password', 'unique:users' => 'The phone number is already in use.']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            DB::beginTransaction();
            $user = User::create([
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'role' => 'user',
            ]);

            $otp = random_int(100000, 999999);
            $reference = Str::random(64);
            $verify = Verify::create([
                'otp' => $otp,
                'otpexpiry' => Carbon::now()->addMinutes(10),
                'reference' => $reference,
                'phone' => $data['phone'],
            ]);

            if (!empty($data['email'])) {
                $token = Str::random(64);
                $verify->token = $token;
                $verify->tokenexpiry = Carbon::now()->addMinutes(60);
                $verify->email = $data['email'];
                $verify->update();

                $verifymail = new EmailVerification([
                    'email' => $data['email'], 
                    'token' => $token,
                ]);

                Mail::to($data['email'])->send($verifymail);
                Mail::to($data['email'])->send(new OtpLink(['reference' => $reference]));
            }

            Sms::otp([
                'otp' => $otp, 
                'phone' => $data['phone'],
            ]);

            DB::commit();
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful',
                'redirect' => route('phone.verify', ['reference' => $reference]),
            ]);

        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }
    }

    /**
     * Api Login
     * 
     */
    public function login()
    {
        $data = request()->only(['login', 'password']);
        $validator = Validator::make($data, [
            'login' => ['required'], 
            'password' => ['required']
        ], ['login.required' => 'Enter your email or phone number.']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $user = User::where(['email' => $data['login']])->first() || User::where(['phone' => $data['login']])->first();
        if (empty($user)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid login details.'
            ]);
        }

        if (auth()->attempt(['email' => $data['login'], 'password' => $data['password']]) || auth()->attempt(['phone' => $data['login'], 'password' => $data['password']])) {
            request()->session()->regenerate();

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.', 
                'redirect' => route('dashboard'),
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Invalid login details'
        ]);
    }
}