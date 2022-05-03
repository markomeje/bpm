<?php

namespace App\Http\Controllers;
use App\Models\{Category, Property};

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index')->with(['title' => env('APP_NAME'), 'properties' => Property::latest('created_at')->where('action', '!=', 'sold')->where(['status' => 'active'])->paginate(27)]);
    }
}
