<?php

namespace App\Http\Controllers\Admin;
use App\Models\Membership;
use App\Http\Controllers\Controller;

class MembershipsController extends Controller
{
    /**
     * Admin memberships page view
     */
    public function index()
    {
        return view('admin.memberships.index')->with(['memberships' => Membership::paginate(24)]);
    }

}
