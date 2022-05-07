<?php

namespace App\Http\Controllers\Api;
use App\Models\{User, Password};
use App\Http\Controllers\Controller;
use \Exception;
use Validator;

class PasswordController extends Controller
{

    /**
     * Api [post] Update password
     */
    public function update()
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