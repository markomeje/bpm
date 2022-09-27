<?php

namespace App\Http\Controllers\Api;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use \Exception;
use Validator;

class RealtorsController extends Controller
{
    /**
     * List of all realtors
     */
    public function realtors($limit = 24)
    {
        $realtors = Profile::latest('created_at')->where(['role' => 'realtor'])->paginate(24);
        return response()->json([
        	'status' => 1,
        	'info' => 'All Realtors Profile',
        	'realtors' => $realtors
        ]);
    }

}