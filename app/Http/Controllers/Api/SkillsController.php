<?php

namespace App\Http\Controllers\Api;
use App\Models\Skill;
use App\Http\Controllers\Controller;

class SkillsController extends Controller
{
    /**
     * All skills
     */
    public function all()
    {
        $limit = 20;
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'skills' => Skill::paginate($limit),
        ]);
    }


}
