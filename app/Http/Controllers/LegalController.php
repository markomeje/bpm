<?php

namespace App\Http\Controllers;
use Artesaos\SEOTools\Facades\SEOMeta;

class LegalController extends Controller
{

    /**
     * Privacy Policy
     * 
     * @return void
     */
    public function privacy()
    {
        SEOMeta::setTitle('Our Privacy Policy');
        SEOMeta::setDescription('This Privacy Policy describes what information we gather from you, how we use and disclose that information, and what we do to protect it. By using the Service, you expressly consent to the privacy practices described in this policy.');
        SEOMeta::addKeyword(['Privacy', 'Policy']);
        return view('frontend.legal.privacy');
    }

}