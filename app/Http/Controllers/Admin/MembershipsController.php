<?php

namespace App\Http\Controllers\Admin;
use App\Models\Membership;
use App\Http\Controllers\Controller;
use Validator;

class MembershipsController extends Controller
{
    /**
     * Admin memberships page view
     */
    public function index()
    {
        return view('admin.memberships.index')->with(['memberships' => Membership::paginate(24)]);
    }

    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'package' => ['required', 'string'],
            'currency' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'freelisting' => ['required', 'integer'],
            'paidlisting' => ['required', 'integer'],
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
        if (request()->user()->cannot('update', ['membership'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Sorry. You cannot perform this operation.'
            ]);
        }

        $data = request()->all();
        $validator = Validator::make($data, [
            'package' => ['required', 'string'],
            'currency' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'freelisting' => ['required', 'integer'],
            'paidlisting' => ['required', 'integer'],
            'duration' => ['required'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $plan = Membership::find($id);
        if(empty($plan)) {
            return response()->json([
                'status' => 0,
                'info' => 'Unkown error. Try again.',
            ]);
        }

        $name = $data['duration'];
        $durations = Membership::$durations;
        if(!isset($durations[$name])) {
            return response()->json([
                'status' => 0,
                'info' => 'Duration error. Try again.',
            ]);
        }

        $plan->currency_id = $data['currency'];
        $plan->package_id = $data['package'];
        $plan->price = $data['price'];
        $plan->paidlisting = $data['paidlisting'];
        $plan->freelisting = $data['freelisting'];
        $plan->duration = $durations[$name];
        $plan->name = $name;
        $plan->update();

        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function delete($id)
    {
        if (request()->user()->cannot('delete', ['plans'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Sorry. You cannot perform this operation.'
            ]);
        }

        Membership::find($id)->delete();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful'
        ]);
    }

}
