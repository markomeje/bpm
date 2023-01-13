<?php

namespace App\Http\Controllers\Api;
use App\Models\Membership;
use App\Http\Controllers\Controller;

class MembershipController extends Controller
{
    /**
     * List of all countries
     */
    public function index()
    {
        $memberships = Membership::all();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'memberships' => $memberships,
        ]);
    }

}