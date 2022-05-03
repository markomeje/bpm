<?php

namespace App\Http\Controllers\Api;
use App\Models\Certification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \Exception;
use Validator;

class CertificationsController extends Controller
{

    /**
     * Add ceriticate
     */
    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'qualification' => ['required', 'string'],
            'institution' => ['required', 'string'],
            'year' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        Certification::create([
            'qualification' => $data['qualification'],
            'institution' => $data['institution'],
            'year' => $data['year'],
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
     * Edit ceriticate
     */
    public function edit($id = 0)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'qualification' => ['required', 'string'],
            'institution' => ['required', 'string'],
            'year' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $certificate = Certification::find($id);
        $certificate->institution = $data['institution'];
        $certificate->year = $data['year'];
        $certificate->qualification = $data['qualification'];
        $certificate->update();
            
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful.',
            'redirect' => '',
        ]);        
    }

    public function delete($id)
    {
        Certification::find($id)->delete();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => '',
        ]);
    }

}