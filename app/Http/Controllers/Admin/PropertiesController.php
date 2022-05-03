<?php

namespace App\Http\Controllers\Admin;
use App\Models\{Category, Property, Country, Image};
use App\Http\Controllers\Controller;
use \Exception;
use Validator;

class PropertiesController extends Controller
{
    /**
     * Admin Properties list view
     */
    public function index()
    {
        return view('admin.properties.index')->with(['properties' => Property::latest('created_at')->paginate(30)]);
    }

    /**
     * Admin get properties by country
     */
    public function country($countryid = 0)
    {
        $properties = Property::whereHas('country', function ($query) use ($countryid) {
            $query->where(['id' => $countryid]);
        })->paginate(12);

        return view('admin.properties.country')->with(['properties' => $properties]);
    }

    /**
     * Admin Property add view
     */
    public function add()
    {
        return view('admin.properties.add')->with(['properties' => Property::latest('created_at')->paginate(5)]);
    }

    /**
     * Admin view to edit property
     */
    public function edit($id = 0)
    {
        $category = request()->get('category');
        return view('admin.properties.edit')->with(['property' => Property::find($id), 'countries' => Country::all(), 'category' => $category]);
    }

    /**
     * Admin get properties by user
     */
    public function action($action = '')
    {
        return view('admin.properties.action')->with(['properties' => Property::where(['action' => $action])->paginate(28), 'action' => $action]);
    }

    /**
     * Admin get properties by category
     */
    public function category($category = 'land')
    {
        return view('admin.properties.category')->with(['properties' => Property::where(['category' => $category])->paginate(24)]);
    }

    /**
     * Admin search Properties
     */
    public function search()
    {
        $query = request()->get('query');
        return view('admin.properties.search')->with(['properties' => Property::search(['category', 'price', 'country.name'], $query)->paginate(24), 'query' => $query]);
    }

}
