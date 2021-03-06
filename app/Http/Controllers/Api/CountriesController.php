<?php

namespace App\Http\Controllers\Api;
use App\Models\Country;
use App\Http\Controllers\Controller;

class CountriesController extends Controller
{
    /**
     * List of all countries
     */
    public function all()
    {
        $countries = Country::all();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'countries' => $countries,
        ]);
    }

}