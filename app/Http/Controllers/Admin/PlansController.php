<?php

namespace App\Http\Controllers\Admin;
use App\Models\{Membership};
use App\Http\Controllers\Controller;
use \Exception;
use Validator;

class PlansController extends Controller
{
	/**
     * Admin membership plans list view
     */
    public function index()
    {
        return view('admin.plans.index')->with(['plans' => Membership::latest('created_at')->paginate(16)]);
    }

    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'details' => ['required', 'string'],
            'name' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'listing' => ['required', 'integer'],
            'duration' => ['required', 'string'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        foreach(Membership::all()->toArray() as $plan) {
            if (($plan['name'] == $data['name']) && ($plan['duration'] == $data['duration'])) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Membership already exists for the selected duration'
                ]);
            }
        }

        $plan = Membership::create([
            'details' => $data['details'],
            'name' => $data['name'],
            'price' => $data['price'],
            'listing' => $data['listing'],
            'duration' => $data['duration'],
        ]);

        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function edit($id)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'details' => ['required', 'string'],
            'name' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'listing' => ['required', 'integer'],
            'duration' => ['required', 'string'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        foreach(Plan::all()->toArray() as $plan) {
            if (($plan['name'] == $data['name']) && ($plan['duration'] == $data['duration']) && ($plan['id'] !== $id)) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Plan already exists for the selected duration'
                ]);
            }
        }

        $plan = Plan::find($id);
        $plan->details = $data['details'];
        $plan->name = $data['name'];
        $plan->price = $data['price'];
        $plan->listing = $data['listing'];
        $plan->duration = $data['duration'];
        $plan->update();

        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function delete($id)
    {
        Plan::find($id)->delete();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful'
        ]);
    }

}