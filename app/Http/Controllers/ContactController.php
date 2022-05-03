<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * About page view
     */
    public function index()
    {
        return view('frontend.contact.index');
    }
}
