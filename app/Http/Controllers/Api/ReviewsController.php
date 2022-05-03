<?php

namespace App\Http\Controllers\Api;
use App\Models\{Review, User};
use App\Http\Controllers\Controller;
use \Exception;
use Validator;


class ReviewsController extends Controller
{

    /**
     * Review a user
     */
    public function add($profileid)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 0, 
                'info' => 'Please login to review this profile.'
            ]);
        }

        $data = request()->only(['review']);
        $validator = Validator::make($data, [
            'review' => ['required', 'string', 'max:50'],
        ]);

        $reviewer = Review::where([
            'profile_id' => $profileid, 
            'user_id' => auth()->id()
        ])->first();

        if (!empty($reviewer)) {
            return response()->json([
                'status' => 0, 
                'info' => 'You have already reviewed this profile.'
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        Review::create([
            'review' => $data['review'],
            'profile_id' => $profileid,
            'status' => 'active',
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => '',
        ]);       
    }

}