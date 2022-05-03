<?php

namespace App\Http\Controllers\User;
use App\Models\{Category, Material, Country};
use App\Http\Controllers\Controller;


class MaterialsController extends Controller
{
	/**
     * User materials list view
     */
    public function index()
    {
        $materials = Material::latest('created_at')->where(['user_id' => auth()->user()->id])->paginate(12);
        return view('user.materials.index')->with(['materials' => $materials]);
    }

    /**
     * User add material view
     */
    public function add()
    {
        return view('user.materials.add')->with(['countries' => Country::all()]);
    }

    /**
     * User edit material view
     */
    public function edit($id = 0)
    {
        $material = Material::where(['id' => $id, 'user_id' => auth()->user()->id])->first();
        return view('user.materials.edit')->with(['material' => $material, 'countries' => Country::all()]);
    }

}