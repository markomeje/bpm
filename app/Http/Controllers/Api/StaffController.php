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
    /**
     * Whitelisted role for staff
     */
    const NOT_ALLOWED_ROLES = ['superadmin', 'user'];

    /**
     * Add staff to as user and to staff table
     */
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

        $role = strtolower($data['role'] ?? '');
        if (in_array($role, self::NOT_ALLOWED_ROLES)) {
            return response()->json([
                'status' => 0,
                'info' => 'Role not allowed',
            ]);
        }

        try {
            DB::beginTransaction();
            $reference = Str::random(64);
            $user = User::create([
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make('233410'),
                'role' => $role,
                'name' => $data['fullname'],
                'status' => 'pending',
            ]);

            Staff::create([
                'user_id' => $user->id,
                'role' => $role,
                'created_by' => auth()->id(),
                'description' => $data['description'] ?? '',
                'code' => $data['code'] ?? '',
                'status' => 'active',
                'type' => 'staff'
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
            'email' => ['required', 'email'], 
            'phone' => ['required'],
            'role' => ['required', 'string'],
            'fullname' => ['required', 'string'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $role = strtolower($data['role'] ?? '');
        if (in_array($role, self::NOT_ALLOWED_ROLES)) {
            $role = ucfirst($role);
            return response()->json([
                'status' => 0,
                'info' => 'The role entered is not allowed',
            ]);
        }

        $user = User::find($id);
        $user->email = $data['email'];
        $user->name = $data['fullname'];
        $user->phone = $data['phone'];
        $user->role = $role;
        $user->update();

        $staff = Staff::where(['user_id' => $user->id])->first();
        if(!empty($staff)) {
            $staff->description = $data['description'];
            $staff->update();

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful',
                'redirect' => ''
            ]);
        }
            
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Operation'
            ]);
        }

        if (!empty($user->staff)) {
            if ($user->staff->created_by !== auth()->id() && auth()->user()->role !== 'superadmin') {
                return response()->json([
                    'status' => 0,
                    'info' => 'You cannot delete staff'
                ]);
            }
        }
        
        $staff = Staff::where(['user_id' => $user->id])->first();
        if(!empty($staff)) {
            $staff->delete();
        }

        $user->delete();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => ''
        ]); 
            
    }

    public function status($id)
    {
        $data = request()->all(['status']);
        $validator = Validator::make($data, [
            'status' => ['required', 'string'], 
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $user = User::find($id);
        if (empty($user)) {
            return response()->json([
                'status' => 0,
                'info' => 'An error occured.',
            ]);
        }

        if (!empty($user->staff)) {
            if ($user->staff->created_by !== auth()->id() && auth()->user()->role !== 'superadmin') {
                return response()->json([
                    'status' => 0,
                    'info' => 'You cannot delete staff'
                ]);
            }
        }

        $user->status = $data['status'] ?? 'inactive';
        $user->update();
        return response()->json([
            'status' => 1,
            'info' => 'Staff status updated.',
            'redirect' => '',
        ]);
    }

}