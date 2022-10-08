<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{

    /**
     * Privacy Policy
     * 
     * @return void
     */
    public function privacy()
    {
        return view('frontend.legal.privacy')->with(['title' => 'Privacy Policy | Best Property Market']);
    }

}