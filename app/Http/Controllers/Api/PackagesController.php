<?php

namespace App\Http\Controllers\Api;
use App\Models\{Membership, Package};
use App\Http\Controllers\Controller;

class PackagesController extends Controller
{
    /**
     * List of all countries
     */
    public function index()
    {
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'packages' => Package::all(),
        ]);
    }

}