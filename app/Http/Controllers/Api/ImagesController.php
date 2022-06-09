<?php

namespace App\Http\Controllers\Api;
use App\Models\Image;
use App\Http\Controllers\Controller;
use App\Helpers\Cloudinary;
use Exception;
use Validator;

/**
 * Handles the uploading all images
 */
class ImagesController extends Controller
{

    /**
     * Upload Api for main images
     */
    public function upload()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'image' => ['required', 'image'],
            'model_id' => ['required'],
            'type' => ['required'],
            'folder' => ['required'],
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid Operation.',
                'error' => $validator->errors()
            ]);
        }

        $dinary = Cloudinary::save($data, request()->file('image'));
        return response()->json([
            'status' => $dinary['status'], 
            'info' => $dinary['info']
        ]);      
            
    }

    public function delete()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'model_id' => ['required'],
            'type' => ['required'],
            'role' => ['required'],
            'public_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid Operation.',
                'error' => $validator->errors()
            ]);
        }

        if ($data['role'] == 'main') {
            $others = Image::where([
                'type' => $data['type'], 
                'model_id' => $data['model_id'],
                'role' => 'others'
            ])->get();

            if ($others->count() > 0) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Not allowed. You must delete other images first.',
                ]);
            }   
        }

        try {
            $image = Image::where([
                'public_id' => $data['public_id'],
                'type' => $data['type'], 
                'model_id' => $data['model_id'], 
                'role' => $data['role'], 
            ])->get()->first();

            if (empty($image)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Image not found. Check your fields'
                ]);
            }

            Cloudinary::delete([$image->public_id]);
            $image->delete();

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => '',
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'Unknown error. Try again.'
            ]);
        }     
    }

    /**
     * Upload multiple images with filepond
     */
    public function multiple()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'images' => ['required'],
            'model_id' => ['required'],
            'type' => ['required'],
            'folder' => ['required'],
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid Operation.',
                'error' => $validator->errors()
            ], 400);
        }

        $maxfiles = ['property' => 4, 'material' => 3];
        $files = request()->file('images');
        $count = Image::where([
            'model_id' => $data['model_id'], 
            'role' => $data['role'], 
            'type' => $data['type']
        ])->get()->count();

        if (isset($maxfiles[$data['type']])) {
            if (($count + count($files)) > $maxfiles[$data['type']]) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid Operation.'
                ], 400);
            }
        }

        if($files = $files){
            foreach($files as $file){
                $dinary = Cloudinary::save($data, $file);
                $status = $dinary['status'];
                return response()->json([
                    'status' => $status, 
                    'info' => $dinary['info']
                ], $status == 0 ? 400 : 200);
            }
        }
    }

}