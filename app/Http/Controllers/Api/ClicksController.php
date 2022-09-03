<?php

namespace App\Http\Controllers\Api;
use App\Models\{Property, Service, Material};
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \Exception;
use Validator;

class ClicksController extends Controller
{

    /**
     * Add ceriticate
     */
    public function record()
    {
        $data = request()->all(['model', 'model_id']);
        $validator = Validator::make($data, [
            'model' => ['required', 'string'],
            'model_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $model = strtolower($data['model'] ?? '');
        if (!in_array($model, ['property', 'material', 'service'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid model. Model must be either property, material, service',
            ]);
        }

        $id = $data['model_id'] ?? '';
        if($model === 'property') {
            $property = Property::find($id);
            if (empty($property)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid property.',
                    'redirect' => '',
                ]);
            }

            $property->views = $property->views + 1;
            if ($property->update()) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Property views updated.',
                    'views' => $property->views,
                ]);
            }

            return response()->json([
                'status' => 0, 
                'info' => 'Updating property views failed. Try again',
            ]);
        }

        if ($model === 'service') {
            $service = Service::find($id);
            if (empty($service)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid service.',
                ]);
            }

            $service->clicks = $service->clicks + 1;
            if ($service->update()) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Service clicks updated.',
                    'views' => $service->clicks,
                ]);
            }

            return response()->json([
                'status' => 0, 
                'info' => 'Updating service clicks failed. Try again',
            ]);
        }

        if($model === 'material') {
            $material = Material::find($id);
            if (empty($material)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid material.',
                    'redirect' => '',
                ]);
            }

            $material->views = $material->views + 1;
            if ($material->update()) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Material views updated.',
                    'views' => $material->views,
                ]);
            }

            return response()->json([
                'status' => 0, 
                'info' => 'Updating material views failed. Try again',
            ]);
        }
            
        return response()->json([
            'status' => 1, 
            'info' => 'Invalid operation. Try again.',
        ]);        
    }

}