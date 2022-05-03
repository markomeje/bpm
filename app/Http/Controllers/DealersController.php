<?php

namespace App\Http\Controllers;
use App\Models\{Profile, Review};
use Illuminate\Http\Request;

class DealersController extends Controller
{
    /**
     * Dealers home page
     */
    public function index()
    {
        return view('frontend.dealers.index')->with(['dealers' => Profile::where(['role' => 'dealer'])->paginate(24)]);
    }

}
