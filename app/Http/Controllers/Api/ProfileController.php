<?php

namespace App\Http\Controllers\Api;
use App\Models\{Profile, User};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;


class ProfileController extends Controller
{
    /**
     * Api add Profile
     */
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:300'],
            'country' => ['required', 'integer'],
            'designation' => ['required', 'string'],
            'state' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['required', 'string', 'max:500'],
            'role' => ['required', 'string'],
            'phone' => ['nullable', 'unique:profiles'],
            'website' => ['nullable', 'url'],
            'email' => ['nullable', 'email', 'unique:profiles'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $role = $data['role'] ?? '';
        if (Str::contains($role, '|')) {
            [$role, $code] = explode('|', $role);
        }

        try {
            DB::beginTransaction();
            $profile = Profile::create([
                'country_id' => $data['country'],
                'description' => $data['description'],
                'state' => $data['state'],
                'address' => $data['address'],
                'city' => $data['city'],
                'website' => $data['website'],
                'email' => $data['email'],
                'user_id' => auth()->id(),
                'designation' => $data['designation'],
                'reference' => Str::random(64),
                'role' => $role,
                'phone' => $data['phone'],
                'code' => empty($code) ? '' : $code,
            ]);

            $user = auth()->user();
            $user->name = $data['name'];
            $user->update();

            DB::commit();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route('user.dashboard'),
            ]);
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again.',
            ]);
        }    

    }

    /**
     * Api edit Profile
     */
    public function edit($id)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:300'],
            'country' => ['required', 'integer'],
            'designation' => ['required', 'string'],
            'state' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['required', 'string', 'max:500'],
            'role' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $role = $data['role'] ?? '';
        if (Str::contains($role, '|')) {
            [$role, $code] = explode('|', $role);
        }

        try {
            DB::beginTransaction();
            if (auth()->user()->name !== $data['name']) {
                $user = User::find(auth()->user()->id);
                $user->name = $data['name'];
                $user->update();
            }

            $profile = Profile::find($id);
            $profile->country_id = $data['country'];
            $profile->state = $data['state'];
            $profile->address = $data['address'];
            $profile->designation = $data['designation'];
            $profile->city = $data['city'];
            $profile->description = $data['description'];
            $profile->code = empty($code) ? '' : $code;
            $profile->phone = $data['phone'];
            $profile->role = $role;
            $profile->update();

            DB::commit();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route('user.dashboard'),
            ]);
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again.',
            ]);
        }    
    }

    /**
     * Updating company specific details
     */
    public function company($id = 0) 
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'companyname' => ['required', 'string', 'max:300'],
            'idnumber' => ['required', 'string'],
            'document' => ['required', 'string'],
            'rcnumber' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        try {
            $profile = Profile::find($id);
            $profile->companyname = $data['companyname'];
            $profile->idnumber = $data['idnumber'];
            $profile->document = $data['document'];
            $profile->rcnumber = $data['rcnumber'];
            $profile->update();

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route('user.dashboard'),
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again.',
            ]);
        } 
    }
}
