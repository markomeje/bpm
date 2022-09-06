<?php 

namespace App\Http\Controllers\Api;
use App\Models\Service;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use \Exception;
use Validator;


class ServicesController extends Controller
{
	/**
     * User creates a service offering
     */
    public function create()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'description' => ['required', 'string', 'max:200'],
            'skill' => ['required', 'integer',],
            'price' => ['required', 'numeric'],
            'currency' => ['required', 'numeric'],
            'status' => ['required'],
        ]);

        $service = Service::where([
            'user_id' => auth()->id(), 
            'skill_id' => $data['skill'] ?? null,
        ])->first();

        if (!empty($service)) {
            return response()->json([
                'status' => 0, 
                'info' => 'You have already created a service with the service selected.'
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $service = Service::create([
            'description' => $data['description'],
            'skill_id' => $data['skill'],
            'price' => $data['price'],
            'user_id' => auth()->id(),
            'status' => $data['status'],
            'currency_id' => $data['currency'],
        ]);

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'service' => $service,
            'redirect' => '',
        ]);       
    }

    /**
     * Delete service,
     * With Image if any
     */
    public function delete($id = 0)
    {
        if(empty($id)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation',
            ]);
        }

        $service = Service::find($id);
        if(empty($service)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Service not found',
            ]);
        }

        if($service->delete()) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0, 
            'info' => 'Operation failed',
        ]);
            
    }

    /**
     * Buy ads credit
     */
    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'description' => ['required', 'string', 'max:200'],
            'skill' => ['required', 'integer',],
            'price' => ['required', 'numeric'],
            'currency' => ['required', 'numeric'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $service = Service::find($id);
        if (empty($service)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Service not found'
            ]);
        }

        $service->description = $data['description'];
        $service->skill_id = $data['skill'];
        $service->price = $data['price'];
        $service->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'service' => $service,
            'redirect' => '',
        ]);       
    }

}