<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Package;

class MembershipController extends Controller
{
    /**
     * Memberships page view
     */
    public function index()
    {
        return view('frontend.membership.index')->with(['packages' => Package::all()]);
    }
}
