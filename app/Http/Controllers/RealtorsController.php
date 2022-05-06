<?php

namespace App\Http\Controllers;
use App\Models\{Profile, Review};
use Illuminate\Http\Request;

class RealtorsController extends Controller
{
    /**
     * Realtors page view
     */
    public function index()
    {
        return view('frontend.realtors.index')->with(['realtors' => Profile::latest()->where(['role' => 'realtor'])->paginate(24)]);
    }

}
