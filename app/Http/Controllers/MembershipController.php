<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Membership;

class MembershipController extends Controller
{
    /**
     * Memberships page view
     */
    public function index()
    {
        return view('frontend.membership.index')->with(['memberships' => Membership::all()]);
    }
}
