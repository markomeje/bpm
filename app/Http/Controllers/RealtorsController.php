<?php

namespace App\Http\Controllers;
use App\Models\{Profile, Review};
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;

class RealtorsController extends Controller
{
    /**
     * Realtors page view
     */
    public function index()
    {
        SEOMeta::setTitle('Properties for Sale, Buy and Lease Globally');
        SEOMeta::setDescription('The work of an agent or realtor is to help prospect buy or sell property. Internet on the other hand paves way for users to connect with more people in a split of seconds. So, as a real estate agent, broker, realtor, World Best Property Market, creates the avenue for you to market your property.');
        SEOMeta::addKeyword(['Real Estate agents', 'Land Agents', 'House Agents', 'Property Agents']);

        return view('frontend.realtors.index')->with(['realtors' => Profile::latest()->where(['role' => 'realtor'])->paginate(24)]);
    }

}
