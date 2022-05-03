<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * About page view
     */
    public function index()
    {
        return view('frontend.about.index');
    }
}
