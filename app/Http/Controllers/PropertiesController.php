<?php

namespace App\Http\Controllers;
use App\Models\{Category, Property, Country};
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;

class PropertiesController extends Controller
{
    /**
     */
    CONST SEO_DESCRIPTION = 'Best Property Market provides Real Estate solutions and access to professional Builders, Artisans, Merchants of Building materials etc. It is a free to register platform for Real Estate dealers to connect with their target market.';

    /**
     * Properties home view
     */
    public function index()
    {
        SEOMeta::setTitle('All kinds of properties, in all countries.');
        SEOMeta::setDescription(self::SEO_DESCRIPTION);
        SEOMeta::addKeyword(['Property', 'Duplexes', 'Flats', 'Semi Detached Duplexes', 'Bungalows', 'Terraces', 'Lands']);

        return view('frontend.properties.index')->with(['properties' => Property::active()->latest('created_at')->where('action', '!=', 'sold')->paginate(24),]);
    }

    /**
     * Find Single Property
     */
    public function property($category = 'land', $id = 45, $slug = '')
    {
        SEOMeta::setDescription(self::SEO_DESCRIPTION);
        $property = Property::find($id);
        if (empty($property)) {
            SEOMeta::setTitle('Property not found');
            return view('frontend.properties.property')->with(['property' => '']);
        }

        $slug = Str::headline($slug);
        SEOMeta::setTitle($slug);
        SEOMeta::addKeyword(explode(' ', ucwords($property->additional)));
        return view('frontend.properties.property')->with(['property' => $property, 'slug' => $slug]); 
    }

    /**
     * Find Properties by category
     */
    public function category($category = 'land')
    {
        SEOMeta::setDescription(self::SEO_DESCRIPTION);
        SEOMeta::addKeyword(['Property', 'Duplexes', 'Flats', 'Semi Detached Duplexes', 'Bungalows', 'Terraces', 'Lands']);
        SEOMeta::setTitle(ucfirst($category).' Properties');
        $properties = Property::active()->latest('created_at')->where(['category' => $category])->where('action', '!=', 'sold')->paginate(18);
        return view('frontend.properties.category')->with(['properties' => $properties, 'name' => $category]);
    }

    /**
     * Find Properties by country
     */
    public function country($iso2 = 'us')
    {
        SEOMeta::setDescription(self::SEO_DESCRIPTION);

        $country = Country::where(['iso2' => $iso2])->first();
        $properties = Property::where(['country_id' => $country->id])->where('action', '!=', 'sold')->paginate(16);
        return view('frontend.properties.country')->with(['properties' => $properties, 'soldProperties' => Property::where(['status' => 'sold off'])->paginate(3), 'country' => $country]);
    }

    public function search()
    {
        SEOMeta::setDescription(self::SEO_DESCRIPTION);

        $query = request()->get('query');
        $properties = Property::search(['price', 'group', 'category', 'bedrooms', 'country.name', 'city', 'state'], $query)->active()->paginate();
        return view('frontend.properties.search')->with(['properties' => $properties]);
    }

    /**
     * Find Properties by action like for sale, for lease etc
     */
    public function action($action = 'lease')
    {
        SEOMeta::setDescription(self::SEO_DESCRIPTION);
        SEOMeta::setTitle('Global Properties '. ucfirst(Property::$actions[$action] ?? ''));

        $properties =  Property::active()->where(['action' => $action])->paginate(16);
        return view('frontend.properties.action')->with(['properties' => $properties, 'action' => $action]);
    }

    /**
     * Find Properties by group e.g., duplex, bungalow etc
     */
    public function group($group = '')
    {
        SEOMeta::setDescription(self::SEO_DESCRIPTION);
        $group = ucwords(Str::headline($group));
        SEOMeta::setTitle(Str::plural($group));
        return view('frontend.properties.group')->with(['properties' => Property::active()->where(['group' => $group])->paginate(16), 'group' => $group]);
    }

}
