<?php

namespace App\Helpers;
use App\Models\Notification;
use Illuminate\Support\Str;
use Exception;
use Image;
use File;
use Storage;

/**
 * Save to cloudinary
 */
class Cloudinary
{
	/**
	 * Save image to cloudinary cloud and database
	 */
	public static function save($data, $file)
    {
        $type = $data['type'] ?? '';
        $format = $file->getClientOriginalExtension();
        if ($type == 'property') {
            $upload = $file->store('public');
            $image = Image::make(Storage::get($upload));
            $image->insert(Storage::get('water.png'))->save(Storage::path($upload));

            $imagepath = $image->basePath();
        }else {
            $imagepath = $file->path();
        }

        try {
            if (empty($data['public_id'])) {
                \Cloudder::upload($imagepath, Str::uuid(), [
                    'folder' => $data['folder'],
                    'overwrite' => false,
                    'resource_type' => 'image', 
                    'responsive' => true,
                ]);

                $public_id = \Cloudder::getPublicId();
                $image = \App\Models\Image::create([
                    'type' => $data['type'],
                    'public_id' => $public_id,
                    'model_id' => $data['model_id'],
                    'link' => \Cloudder::secureShow($public_id),
                    'role' => $data['role'],
                    'format' => $format,
                    'user_id' => auth()->id(),
                ]);

                return [
                    'status' => 1, 
                    'info' => 'Operation successful.',
                    'image' => $image,
                ];
            }

            $image = \App\Models\Image::where([
                'public_id' => $data['public_id'],
                'type' => $data['type'], 
                'model_id' => $data['model_id'], 
                'role' => $data['role'],
                'user_id' => auth()->id(),
            ])->first();

            \Cloudder::delete($image->public_id);
            \Cloudder::upload($imagepath, Str::uuid(), [
                'folder' => $data['folder'],
                'overwrite' => false,
                'resource_type' => 'image', 
                'responsive' => true, 
                'transformation' => ['quality' => 100, 'crop' => 'scale']
            ]);

            $public_id = \Cloudder::getPublicId();
            $image->link = \Cloudder::secureShow($public_id);
            $image->format = $format;
            $image->public_id = $public_id;
            $image->update();

            return [
                'status' => 1, 
                'info' => 'Operation successful.',
                'image' => $image
            ];
        } catch (Exception $error) {
            return [
                'status' => 0, 
                'info' => 'Unknown error. Try again.',
                'image' => ''
            ];
        }
    }

    public static function delete(array $public_ids) {
        try {
            if (!is_array($public_ids)) {
                throw new Exception('Parameter must be an array');
            }

            \Cloudder::destroyImages($public_ids);
            return [
                'status' => 1, 
                'info' => 'Operation successful.'
            ];
        } catch (Exception $error) {
            return [
                'status' => 0, 
                'info' => 'Unknown error. Try again.'
            ];
        }
    }
}