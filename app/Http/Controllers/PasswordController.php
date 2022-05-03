<?php

namespace App\Http\Controllers;
use App\Mail\PasswordReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{User, Password};
use Validator;
use DB;
use Mail;
use Hash;


class PasswordController extends Controller
{
    public function index()
    {
        return view('frontend.password.index');
    }

    public function email(Request $request)
    {
        $data = $request->only('email');
        $validator = Validator::make($data, [
            'email' => ['required', 'email']
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $token = Str::random(64);
        $email = $data['email'];
        Password::where(['email' => $email])->delete();
        Password::insert([
            'email' => $email, 
            'token' => $token,
            'duration' => 24, //24hours
        ]);

        try {
            $mail = new PasswordReset([
                'email' => $email, 
                'token' => $token
            ]);

            Mail::to($email)->send($mail);
            return response()->json([
                'status' => 1,
                'info' => 'A password reset link has been sent.',
                'redirect' => route('forgot.password', ['token' => $token]),
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Network Error. Try Again.'
            ]);
        }
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

    public function reset(Request $request)
    {
        $data = $request->only('password', 'confirmpassword', 'email');
        $validator = Validator::make($data, [
            'password' => ['required', 'min:8'],
            'confirmpassword' => ['required'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        if ($data['password'] !== $data['confirmpassword']) {
            return response()->json([
                'status' => 0,
                'info' => 'Passwords do not match.'
            ]);
        }

        $email = $data['email'] ?? null;
        if (empty($email)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Operation. Try Again Later.'
            ]);
        }

        $user = User::where(['email' => $email])->first();
        $user->password = Hash::make($data['password']);
        if($user->update()) {
            Password::where(['email' => $email])->delete();
            return response()->json([
                'status' => 1,
                'info' => 'Operation Successful',
                'redirect' => route('logout')
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Operation Failed. Try Again.',
        ]);
    }
}
