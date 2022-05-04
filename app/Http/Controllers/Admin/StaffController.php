<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Admin staff page view
     */
    public function index()
    {
        return view('admin.staff.index')->with(['staffs' => User::where('role', '!=', 'user')->get()]);
    }

}
