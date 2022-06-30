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
     * Upload Api for main image
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

        try{
            $dinary = Cloudinary::save($data, request()->file('image'));
            return response()->json([
                'status' => $dinary['status'], 
                'info' => $dinary['info'],
                'image' => $dinary['image'] ?? '',
            ]); 

        } catch (Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'Unknown error. Try again.'
            ]);
        } 
            
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
            ]);
        }

        $files = request()->file('images');
        if(!is_array($files) || count($files) <= 0){
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid files sent.'
            ]);
        }

        $type = $data['type'] ?? '';
        $image = Image::where([
            'model_id' => $data['model_id'], 
            'role' => $data['role'], 
            'type' => $type,
        ])->get();

        $maxfiles = ['property' => 4, 'material' => 3];
        if (isset($maxfiles[$type])) {
            if (($image->count() + count($files)) > $maxfiles[$type]) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Maximum file upload reached.'
                ]);
            }
        }

        $images = [];
        foreach($files as $file){
            $dinary = Cloudinary::save($data, $file);
            $images[] = $dinary;
        }

        return response()->json([
            'status' => $dinary['status'], 
            'info' => $dinary['info'],
            'images' => $images,
        ]);
    }

    /**
     * Upload API for Mobile
     */
    public function mobile()
    {
        try {
            $data = request()->only(['file', 'folder']);
            $upload = \Cloudder::upload($data['file'], \Str::uuid(), [
                'folder' => $data['folder'],
                'overwrite' => false,
                'resource_type' => 'image', 
                'responsive' => true,
            ]);

            if ($upload) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Operation successful',
                    'upload' => [
                        'public_id' => \Cloudder::getPublicId(), 
                        'upload' => $upload
                    ],
                ]);
            }

            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => $error->getCode(), 
                'info' => $error->getMessage()
            ]);
        }
            
    }

}