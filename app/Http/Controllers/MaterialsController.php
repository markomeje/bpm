<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    
    /**
     * Building materials page
     */
    public function index()
    {
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
