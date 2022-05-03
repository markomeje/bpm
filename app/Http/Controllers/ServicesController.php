<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Services page view
     */
    public function index()
    {
        return view('frontend.services.index');
    }
}
