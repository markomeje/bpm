<?php

namespace App\Http\Controllers\Api;
use App\Models\Social;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \Exception;
use Validator;

class SocialsController extends Controller
{

    /**
     * Add social
     */
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'company' => ['required', 'string'],
            'link' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'username' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        if ($data['company'] == 'whatsapp' && empty($data['phone'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Enter your whatsapp number',
            ]); 
        }

        if ($data['company'] !== 'whatsapp' && empty($data['link'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Enter your social media link',
            ]); 
        }

        Social::create([
            'company' => $data['company'],
            'link' => $data['link'] ?? null,
            'phone' => $data['phone'] ?? null,
            'username' => $data['username'] ?? null,
            'reference' => Str::random(64),
            'user_id' => auth()->id(),
        ]);
            
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => '',
        ]);        
    }

    /**
     * Edit social
     */
    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'company' => ['required', 'string'],
            'link' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'username' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $social = Social::find($id);
        $social->company = $data['company'];
        $social->link = $data['link'];
        $social->phone = $data['phone'];
        $social->username = $data['username'];
        $social->update();
            
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => '',
        ]);        
    }

    /**
     * Edit social
     */
    public function delete($id = 0)
    {
        $social = Social::where(['id' => $id, 'user_id' => auth()->id()])->first();
        if (empty($social)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid social media details.',
            ]);  
        }

        $social->delete();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => '',
        ]);        
    }

    /**
     * Social media companies
     */
    public function companies()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'companies' => Social::$companies,
        ]);        
    }

}