<?php

namespace App\Http\Controllers\Api;
use App\Models\{Credit, Property, Country, Image, Promotion};
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Helpers\Cloudinary;
use \Carbon\Carbon;
use \Exception;
use Validator;
use DB;

class PropertiesController extends Controller
{
	/**
     * Api add Property
     */
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'country' => ['required', 'integer'],
            'state' => ['required', 'string'],
            'category' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'currency' => ['nullable', 'integer'],
            'action' => ['required', 'string'],
            'measurement' => ['nullable', 'string'],
            'additional' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $property = Property::create([
            'country_id' => $data['country'],
            'state' => $data['state'],
            'address' => $data['address'],
            'city' => $data['city'],
            'action' => strtolower($data['action']),
            'category' => strtolower($data['category']),
            'measurement' => $data['measurement'] ?? '',
            'user_id' => auth()->id(),
            'additional' => $data['additional'],
            'reference' => Str::random(64),
            'currency_id' => $data['currency'] ?? 0,
            'price' => $data['price'],
            'status' => 'inactive',
        ]);

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => route(request()->subdomain().'.property.edit', [
                'id' => $property->id,
                'category' => strtolower($property->category),
            ]),
            'property' => $property,
        ]); 

    }

    /**
     * Api [post] edit Property
     */
    public function update($id = 0, $category = 'any')
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'country' => ['required', 'integer'],
            'state' => ['required', 'string'],
            'category' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'currency' => ['nullable', 'integer'],
            'action' => ['required', 'string'],
            'measurement' => ['nullable', 'string'],
            'additional' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $property = Property::findOrFail($id);
        $property->country_id = $data['country'];
        $property->state = $data['state'];
        $property->address = $data['address'];
        $property->city = $data['city'];
        $property->action = strtolower($data['action']);
        $property->category = strtolower($data['category']);
        $property->measurement = $data['measurement'] ?? '';
        $property->additional = $data['additional'];
        $property->price = $data['price'];
        $property->currency_id = $data['currency'] ?? 0;
        $property->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => route(request()->subdomain().'.properties'),
            'property' => $property,
        ]);
            
    }

    /**
     * Api update property action
     */
    public function action($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'action' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $property = Property::find($id);
        $property->action = strtolower($data['action']);
        $updated = $property->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => '',
        ]);
    }

    /**
     * Api update property specifics
     * 
     * Like only residential properties should have bedrooms
     */
    public function specifics($id, $category = 'land')
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'group' => ['nullable', 'string'],
            'bedrooms' => ['nullable', 'integer'],
            'toilets' => ['nullable', 'integer'],
            'listed' => ['required', 'string'],
        ], ['listed.required' => 'Please select yes or no']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $property = Property::find($id);
        $listed = $data['listed'] ?? '';
        if (empty($property->images->count()) && $listed == 'yes') {
            return response()->json([
                'status' => 0, 
                'info' => 'You have to upload property images before activating.',
                'redirect' => '',
            ]);
        }

        $property->group = strtolower($data['group']);
        $property->bedrooms = $data['bedrooms'] ?? null;
        $property->toilets = $data['toilets'] ?? null;
        $property->listed = $listed;
        $property->status = $listed == 'yes' ? 'active' : 'inactive';
        $updated = $property->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => route(request()->subdomain().'.properties'),
        ]);
    }

    /**
     * Api delete property with its images
     */
    public function delete($id = 0)
    {
        if(empty($id)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation',
            ]);
        }

        $property = Property::find($id);
        if(empty($property)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation',
            ]);
        }

        if ($property->images()->count() > 0) {
            Cloudinary::delete($property->images()->pluck('public_id')->toArray());
        }

        $property->delete();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => '',
        ]);
    }

    /**
     * Api get all property with its images
     */
    public function all()
    {
        $limit = request()->get('limit');
        $properties = Property::with(['images'])->active()->latest()->paginate($limit ?? 20);
        foreach ($properties as $property) {
            $property->setAttribute('title', retitle($property));
        }

        $distinct = Property::distinct();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'properties' => $properties,
            'categories' => $distinct->pluck('category'),
            'groups' => $distinct->pluck('group'),
            'actions' => $distinct->pluck('action'),
        ]);
    }

    /**
     * Api filter properties by category, group or action
     */
    public function filter($type = '')
    {
        $types = ['category', 'action', 'group'];
        if (empty($type) || !in_array($type, $types)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid filter type. Must be one of the types below.',
                'types' => $types,
            ]);
        }

        $limit = request()->get('limit') ?? 20;
        $filter = request()->get('filter');

        if ($filter) {
            $filter = Str::slug($filter);
            switch ($type) {
                case 'category':
                    $properties = Property::with(['images'])->where(['category' => $filter])->get();
                    $properties = $properties->count() <= $limit ? $properties : $properties->paginate($limit);
                    foreach ($properties as $property) {
                        $property->setAttribute('title', retitle($property));
                    }

                    if ($properties->count() <= 0) {
                        return response()->json([
                            'status' => 0, 
                            'info' => 'No properties found for the category filter',
                            'properties' => $properties,
                        ]);
                    }

                    break;

                case 'action':
                    $properties = Property::with(['images'])->where(['action' => $filter])->get();
                    $properties = $properties->count() < $limit ? $properties : $properties->paginate($limit);
                    foreach ($properties as $property) {
                        $property->setAttribute('title', retitle($property));
                    }

                    if ($properties->count() <= 0) {
                        return response()->json([
                            'status' => 0, 
                            'info' => 'No properties found for the action filter',
                            'properties' => $properties,
                        ]);
                    }
                    break;

                case 'group':
                    $properties = Property::with(['images'])->where(['group' => $filter])->get();
                    $properties = $properties->count() < $limit ? $properties : $properties->paginate($limit);
                    foreach ($properties as $property) {
                        $property->setAttribute('title', retitle($property));
                    }

                    if ($properties->count() <= 0) {
                        return response()->json([
                            'status' => 0, 
                            'info' => 'No properties found for the group filter',
                            'properties' => $properties,
                        ]);
                    }
                
                default:
                    $properties = Property::with(['images'])->paginate($limit);
                    foreach ($properties as $property) {
                        $property->setAttribute('title', retitle($property));
                    }
                    break;
            }
        }else {
            $properties = Property::with(['images'])->search(['group', 'category', 'action'], $type)->get();
            $properties = $properties->count() <= $limit ? $properties : $properties->paginate($limit);
            foreach ($properties as $property) {
                $property->setAttribute('title', retitle($property));
            }

            if ($properties->count() <= 0) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'No properties found. Filter is empty',
                    'properties' => $properties,
                ]);
            }
        }
            
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'properties' => $properties,
        ]);
    }

    /**
     * Api search properties
     */
    public function search()
    {
        $query = request()->get('query');
        $limit = request()->get('limit') ?? 20;
        if ($query) {
            $properties = Property::with(['images'])->filterSearch(['price', 'additional', 'group', 'category', 'action', 'bedrooms', 'address', 'toilets', 'state', 'city'], $query)->paginate($limit);
            foreach ($properties as $property) {
                $property->setAttribute('title', retitle($property));
            }

            $distinct = Property::distinct();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'properties' => $properties,
                'categories' => $distinct->pluck('category'),
                'groups' => $distinct->pluck('group'),
                'actions' => $distinct->pluck('action'),
            ]);
        }

        return response()->json([
            'status' => 1, 
            'info' => 'No query supplied. Random properties returned',
            'properties' => Property::with(['images'])->inRandomOrder()->paginate($limit),
        ]);
    }
}