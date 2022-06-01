<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;

class MaterialsController extends Controller
{
    
    /**
     * Building materials page
     */
    public function index()
    {
        SEOMeta::setTitle('Genuine Online Building Materials Market');
        SEOMeta::setDescription('As a Provider of quality construction equipment and building materials, our platform gives you direct access to retailers, distributors, whole-sellers, factory producers and buyers etc. Our platform grants you free, and unlimited opportunities to be seen both locally and in the worldwide market.');
        SEOMeta::addKeyword(['Building Materials', 'Building Materials retailers', 'Building Materials distributors', 'Building Materials wholesalers', 'Building Materials factory', 'Building Materials producers', 'Building Materials buyers']);

        $term = request()->get('query');
        $materials = $term ? Material::latest('created_at')->where('city', 'LIKE', '%'.$term.'%')->orWhere('state', 'LIKE', '%'.$term.'%')->orWhere('price', 'LIKE', '%'.$term.'%')->orWhere('name', 'LIKE', '%'.$term.'%')->orWhere('address', 'LIKE', '%'.$term.'%')->orderBy('id', 'desc')->paginate(24) : Material::latest('created_at')->paginate(24);
        return view('frontend.materials.index')->with(['materials' => $materials]);
    }

    /**
     * Find Single material
     */
    public function material($id = 45, $slug = '')
    {
        return view('frontend.materials.material')->with(['material' => Material::findOrFail($id)]); 
    }

    public function search()
    {
        $term = request()->get('query');
        $properties = Material::where('city', 'LIKE', '%'.$term.'%')->orWhere('state', 'LIKE', '%'.$term.'%')->orWhere('price', 'LIKE', '%'.$term.'%')->orWhere('name', 'LIKE', '%'.$term.'%')->orWhere('address', 'LIKE', '%'.$term.'%')->orderBy('id', 'desc')->paginate(25);
        return view('frontend.materials.search')->with(['properties' => $properties]);
    }
}
