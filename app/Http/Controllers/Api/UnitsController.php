<?php

namespace App\Http\Controllers\Api;
use App\Models\Unit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \Exception;
use Validator;

class UnitsController extends Controller
{

    /**
     * Add unit
     */
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'price' => ['required', 'string'],
            'units' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        Unit::create([
            'price' => $data['price'],
            'currency_id' => $data['currency'],
            'units' => $data['units'],
            'duration' => $data['duration'],
            'reference' => Str::uuid(),
            'user_id' => auth()->id(),
        ]);
            
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => '',
        ]);        
    }

    /**
     * Edit unit
     */
    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'price' => ['required', 'string'],
            'units' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $unit = Unit::find($id);
        $unit->units = $data['units'];
        $unit->currency_id = $data['currency'];
        $unit->duration = $data['duration'];
        $unit->price = $data['price'];
        $unit->update();
            
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => '',
        ]);        
    }

    /**
     * Delete unit
     */
    public function delete($id = 0)
    {
        $unit = Unit::find($id);
        if (empty($unit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation'
            ]);
        }

        if ($unit->credits()->exists()) {
            return response()->json([
                'status' => 0, 
                'info' => 'The unit is already in use.'
            ]);
        }

        $unit->delete();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successfull',
            'redirect' => ''
        ]);
    }

}