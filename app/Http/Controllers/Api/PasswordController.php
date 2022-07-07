<?php

namespace App\Http\Controllers\Api;
use App\Models\{User, Password};
use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use Illuminate\Support\Str;
use \Exception;
use Validator;
use DB;
use Mail;
use Hash;


class PasswordController extends Controller
{
    /**
     * Api [post] Update password
     */
    public function reset()
    {
        $data = request()->only('password', 'confirmpassword', 'email');
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
        $updated = $user->update();
        if($updated) {
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

    /**
     * Process password reset
     */
    public function process()
    {
        $data = request()->only('email');
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

    /**
     * Api [post] Update password
     */
    public function update()
    {
        $data = request()->only(['password', 'currentpassword', 'retype']);
        $validator = Validator::make($data, [
            'currentpassword' => ['required'],
            'password' => ['required'],
            'retype' => ['required'],
        ], ['currentpassword.required' => 'Your current password is required.']);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $password = $data['password'] ?? '';
        $user = auth()->user();
        if (!password_verify($data['currentpassword'], $user->password)) {
            return response()->json([
                'status' => 0,
                'info' => 'Your current password is incorrect.'
            ]);
        }

        $new_password = $data['password'] ?? '';
        if ($new_password !== $data['retype']) {
            return response()->json([
                'status' => 0,
                'info' => 'New password and retype new password do not match.'
            ]);
        }

        $user->password = Hash::make($new_password);
        if($user->update()) {
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