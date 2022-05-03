<?php

namespace App\Http\Controllers\Admin;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitsController extends Controller
{
    /**
     * Admin countries page view
     */
    public function index()
    {
        return view('admin.units.index')->with(['units' => Unit::latest()->paginate(24)]);
    }

}
