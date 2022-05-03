<?php

namespace App\Http\Controllers\Admin;
use App\Models\Staff;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Admin staff page view
     */
    public function index()
    {
        return view('admin.staff.index')->with(['staffs' => Staff::paginate(24)]);
    }

}
