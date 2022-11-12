<?php

namespace App\Http\Controllers;
use App\Models\{Category, Property};
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\Redfin;

class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Global Property and Services Listing Site');
        SEOMeta::setDescription('As a professional and non-professional service provider, we help you advertise your talent to the world by leveraging innovative technologies to get you connected in the market locally and globally');
        SEOMeta::addKeyword(['Buy', 'Rent', 'Sell', 'Real Estate', 'Properties']);

        $properties = Property::latest('created_at')->where('action', '!=', 'sold')->where(['status' => 'active'])->paginate(27);
        //dd($redfin);
        return view('frontend.home.index')->with(['title' => env('APP_NAME'), 'properties' => $properties]);
    }
}
