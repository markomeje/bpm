<?php

namespace App\Http\Controllers\Admin;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountriesController extends Controller
{
    /**
     * Admin countries page view
     */
    public function index()
    {
        $countries = Country::with('properties')->get()->SortByDesc(function($country){
            return $country->properties->count();
        })->paginate(24);

        return view('admin.countries.index')->with(['countries' => $countries]);
    }

}
