<?php

namespace App\Http\Controllers;
use Artesaos\SEOTools\Facades\SEOMeta;

class AboutController extends Controller
{
    /**
     * About page view
     */
    public function index()
    {
        SEOMeta::setTitle('Worldwide property industry for Real Estate Professionals');
        SEOMeta::setDescription('We are global Real Estate property listing, search, and match engine company leveraging new innovative technologies. We are strategically positioned to solve multiple property transaction problems in the global real estate market.');
        SEOMeta::addKeyword(['Real Estate developers', 'brokerage', 'property management']);

        return view('frontend.about.index');
    }
}
