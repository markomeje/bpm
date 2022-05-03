<?php

namespace App\Http\Controllers\Admin;
use App\Models\{Category, Skill, Country};
use App\Http\Controllers\Controller;
use Validator;

class SkillsController extends Controller
{
    /**
     * Admin skills list view
     */
    public function index($limit = 12)
    {
        return view('admin.skills.index')->with(['skills' => Skill::latest('created_at')->paginate(16)]);
    }

    public function status($id)
    {
        $skill = Skill::find($id);
        $skill->status = (boolean)$skill->status ? false : true;
        $skill->update();
        return response()->json([
            'status' => 1, 
            'info' => 'Skill status updated successfully'
        ]);
    }

    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'unique:skills'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        Skill::create([
            'name' => $data['name'],
            'status' => true,
        ]);

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $skills = Skill::all()->toArray();
        if (!empty($skills)) {
            foreach($skills as $skill) {
                if (($skill['name'] == $data['name']) && ($skill['id'] !== $id)) {
                    return response()->json([
                        'status' => 0,
                        'info' => 'Skill name already exists'
                    ]);
                }
            }
        }

        $Skill = Skill::find($id);
        $Skill->name = $data['name'];
        $Skill->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation Successful',
            'redirect' => ''
        ]);

    }


}
