<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    /**
     * User profile view
     */
    public function index()
    {
        return view('user.profile.index')->with(['profile' => auth()->user()->profile]);
    }

    /**
     * User profile setup view
     */
    public function setup()
    {
        return view('user.profile.setup')->with([]);
    }
}
