<?php

namespace App\Http\Controllers\User;
use App\Models\{Category, Property, Country, Promotion, Credit};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use \Carbon\Carbon;
use Sk\Geo\Facades\Geo;


class PropertiesController extends Controller
{
	/**
     * User Properties list view
     */
    public function index()
    {
        $properties = auth()->user()->properties()->orderBy('created_at', 'desc')->paginate(12);
        return view('user.properties.index')->with(['properties' => $properties]);
    }

    /**
     * User add property view
     */
    public function add()
    {
        return view('user.properties.add')->with(['countries' => Country::all()]);
    }

    /**
     * User edit property view
     */
    public function edit($category, $id = 0)
    {
        return view('user.properties.edit')->with(['countries' => Country::all(), 'property' => Property::find($id), 'category' => $category]);
    }

}