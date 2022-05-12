<?php

namespace App\Http\Controllers\Api;
use App\Models\{Permission, User};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;


class PermissionsController extends Controller
{

    /**
     * Admin assign permissions
     */
    public function assign()
    {
        $data = request()->only(['resource', 'permission', 'user_id']);
        $validator = Validator::make($data, [
            'resource' => ['required'],
            'user_id' => ['required'],
            'permission' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'info' => 'An error occured. Try again.'
            ]);
        }

        $permission = Permission::where([
            'resource' => $data['resource'], 
            'permission' => $data['permission'], 
            'user_id' => $data['user_id']
        ])->first();

        if (empty($permission)) {
            Permission::create([
                'resource' => $data['resource'], 
                'permission' => $data['permission'], 
                'user_id' => $data['user_id'],
                'description' => 'No description',
            ]);

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful.',
                'redirect' => ''
            ]); 
        }

        $permission->permission = $data['permission'];
        $permission->user_id = $data['user_id'];
        $permission->resource = $data['resource'];
        $permission->update();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => ''
        ]); 
    }

    /**
     * Admin assign permissions
     */
    public function remove($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => ''
        ]); 
    }

}