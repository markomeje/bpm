<?php

namespace App\Http\Controllers\Api;
use App\Models\{Membership};
use App\Http\Controllers\Controller;
use App\Mail\{EmailVerification, OtpLink};
use Illuminate\Support\Facades\DB;
use App\Models\{User, Verify, Staff};
use App\Helpers\Sms;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Hash;
use Mail;
use Exception;

class StaffController extends Controller
{

    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'unique:users'], 
            'phone' => ['required', 'unique:users'],
            'role' => ['required', 'string'],
            'fullname' => ['required', 'string'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $whitelisted = ['superadmin', 'manager'];
        if (in_array($data['role'], $whitelisted)) {
            $role = ucfirst($data['role']);
            return response()->json([
                'status' => 0,
                'info' => "{$role} role not allowed",
            ]);
        }

        try {
            DB::beginTransaction();
            $reference = Str::random(64);
            $user = User::create([
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($reference),
                'role' => 'admin',
                'name' => $data['fullname'],
            ]);

            Staff::create([
                'role' => $data['role'],
                'user_id' => $user->id,
                'created_by' => auth()->id(),
                'description' => $data['description'],
                'status' => 'inactive',
                'verified' => false,
            ]);

            $otp = random_int(100000, 999999);
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
                $mail = new EmailVerification([
                    'email' => $data['email'], 
                    'token' => $token,
                ]);

                Mail::to($data['email'])->send($mail);
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
                'redirect' => '',
            ]);

        } catch (Exception $error) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again later',
            ]);
        }
    }

    public function edit($id)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'unique:users'], 
            'phone' => ['required', 'unique:users'],
            'role' => ['required', 'string'],
            'fullname' => ['required', 'string'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $whitelisted = ['superadmin', 'manager'];
        if (in_array($data['role'], $whitelisted)) {
            $role = ucfirst($data['role']);
            return response()->json([
                'status' => 0,
                'info' => "{$role} role not allowed",
            ]);
        }

        $staff = Staff::find($id);
        $staff->description = $data['description'];
        $staff->role = $data['role'];
        $staff->update();

        $staff = User::find($staff->user->id);
        $staff->email = $data['email'];
        $staff->phone = $data['phone'];
        $staff->name = $data['fullname'];
        $staff->update();

        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function delete($id)
    {
        Staff::find($id)->delete();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful'
        ]);
    }

    public function status($id, $status = '')
    {
        $staff = Staff::find($id);
        $staff->status = $status;
        $staff->update();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => '',
        ]);
    }

}