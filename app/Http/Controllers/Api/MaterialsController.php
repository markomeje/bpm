<?php

namespace App\Http\Controllers\Api;
use App\Models\{Category, Material, Country, Image, Division};
use App\Http\Controllers\Controller;
use App\Helpers\Cloudinary;
use \Exception;
use Validator;

class MaterialsController extends Controller
{
	/**
     * Api add Material
     */
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:300'],
            'country' => ['required', 'integer'],
            'state' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'currency' => ['required', 'integer'],
            'additional' => ['required', 'string', 'max:500'],
            'quantity' => ['nullable'],
            'price' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $material = Material::create([
            'name' => $data['name'],
            'country_id' => $data['country'],
            'state' => $data['state'],
            'address' => $data['address'],
            'city' => $data['city'],
            'quantity' => $data['quantity'] ?? '',
            'user_id' => auth()->user()->id,
            'additional' => $data['additional'],
            'reference' => \Str::uuid(),
            'currency_id' => $data['currency'] ?? 0,
            'price' => $data['price'] ?? '',
        ]);

        if ($material) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route(request()->subdomain().'.material.edit', ['id' => $material->id]),
                'material' => $material,
            ]); 
        }else {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again.',
            ]);   
        }

    }

    /**
     * Delete a building Material,
     * With Images if any
     */
    public function delete($id = 0)
    {
        if(empty($id)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation',
            ]);
        }

        $material = Material::find($id);
        if(empty($material)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation',
            ]);
        }

        if ($material->images()->count() > 0) {
            Cloudinary::delete($material->images()->pluck('public_id')->toArray());
        }

        $material->delete();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => '',
        ]);
    }

    /**
     * Api [post] edit Material
     */
    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:300'],
            'country' => ['required', 'integer'],
            'state' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'currency' => ['required', 'integer'],
            'additional' => ['required', 'string', 'max:500'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $material = Material::find($id);
        if (empty($material)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Building material not found.',
            ]);
        }

        $material->name = $data['name'];
        $material->country_id = $data['country'];
        $material->state = $data['state'];
        $material->address = $data['address'];
        $material->city = $data['city'];
        $material->quantity = $data['quantity'] ?? '';
        $material->additional = $data['additional'];
        $material->price = $data['price'] ?? '';
        $material->currency_id = $data['currency'] ?? 0;
        
        if ($material->update()) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'material' => $material,
                'redirect' => route('user.materials'),
            ]);
        }

        return response()->json([
            'status' => 1, 
            'info' => 'Operation failed. Try again',
        ], 500);
            
    }

}