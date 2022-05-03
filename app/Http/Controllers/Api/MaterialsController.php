<?php

namespace App\Http\Controllers\Api;
use App\Models\{Category, Material, Country, Image, Division};
use App\Http\Controllers\Controller;
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
            'quantity' => $data['quantity'],
            'user_id' => auth()->user()->id,
            'additional' => $data['additional'],
            'reference' => \Str::uuid(),
            'currency_id' => $data['currency'] ?? 0,
            'price' => $data['price'],
        ]);

        if ($material) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route(request()->subdomain().'.material.edit', [
                    'id' => $material->id,
                ]),
            ]); 
        }else {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again.',
            ]);   
        }

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
        $material->name = $data['name'];
        $material->country_id = $data['country'];
        $material->state = $data['state'];
        $material->address = $data['address'];
        $material->city = $data['city'];
        $material->quantity = $data['quantity'];
        $material->additional = $data['additional'];
        $material->price = $data['price'];
        $material->currency_id = $data['currency'] ?? 0;
        $updated = $material->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => route('user.materials'),
        ]);
            
    }

    /**
     * Material api for image upload
     */
    public function image($id = 0, $role = 'main')
    {
        $image = request()->file('image');
        $validator = Validator::make(['image' => $image], [
            'image' => ['required', 'image']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $extension = $image->getClientOriginalExtension();
        $filename = \Str::uuid().'.'.$extension;
        $path = 'images/materials';
        $link = env('APP_URL')."/images/materials/{$filename}";

        /**
         * Delete previous image file if any
         */
        $delete = function($imageurl = '') use($path) {
            $prevfile = explode('/', $imageurl);
            $previmage = end($prevfile);
            $file = "{$path}/{$previmage}";
            if (file_exists($file)) {
                unlink($file);
            }
        };

        $material = Material::find($id);
        if (is_string($role) && $role === 'main') {
            $imageurl = $material->image ?? '';
            if (!empty($imageurl)) $delete($imageurl);

            $material->image = $link;
            $image->move($path, $filename);
            $material->update();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful'
            ]);
        }else {
            $imageid = $role;
            $picture = Image::where(['material_id' => $id, 'id' => $imageid])->first();
            if (empty($picture)) {
                $lastid = Image::create([
                    'material_id' => $id,
                    'link' => $link,
                    'type' => 'material',
                    'reference' => \Str::uuid(),
                ])->id;

                if($lastid) {
                    $image->move($path, $filename);
                    return response()->json([
                        'status' => 1, 
                        'info' => 'Operation successful'
                    ]);
                }else {
                    return response()->json([
                        'status' => 1, 
                        'info' => 'Operation failed'
                    ]);
                }
            }

            $imageurl = $picture->link ?? '';
            if (!empty($imageurl)) $delete($imageurl);
            $picture->link = $link;
            $success = $picture->update();

            if ($success) {
                $image->move($path, $filename);
                return response()->json([
                    'status' => 1, 
                    'info' => 'Operation successful'
                ]);
            }else {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Operation failed'
                ]);
            }
                
        }     
    }

}