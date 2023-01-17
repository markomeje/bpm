<?php

namespace App\Http\Controllers\Api;
use App\Models\{Membership, Package};
use App\Http\Controllers\Controller;

class MembershipController extends Controller
{
    /**
     * List of all countries
     */
    public function find($package_id = 0)
    {
        $package = Package::find($package_id);
        if (empty($package)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid Package',
            ]);
        }

        $memberships = $package->memberships;
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'total' => $memberships->count().' Memberships',
            'package' => $package->name,
            'memberships' => $memberships,
        ]);
    }

}