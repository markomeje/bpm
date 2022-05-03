<?php

namespace App\Http\Controllers\Api;
use App\Models\{User};
use App\Http\Controllers\Controller;
use \Exception;
use Validator;

class PasswordController extends Controller
{

    /**
     * Api [post] edit Material
     */
    public function update($id = 0)
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

        $material = User::find($id);
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

        if ($updated) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route("{$this->subdomain}.material.edit", [
                    'id' => $material->id, 
                ]),
            ]);
        }else {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed',
            ]);
        }

            
    }

}