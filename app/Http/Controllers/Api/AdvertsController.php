<?php

namespace App\Http\Controllers\Api;
use App\Models\{Advert, Credit, Image};
use App\Http\Controllers\Controller;
use App\Helpers\{Timing, Cloudinary};
use Illuminate\Support\Str;
use \Carbon\Carbon;
use \Exception;
use Validator;

class AdvertsController extends Controller
{
	/**
     * Post advert
     */
    public function post()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'credit' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'link' => ['required', 'string'],
            'size' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $credit = Credit::find($data['credit']);
        if (empty($credit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid advert credit'
            ]);
        }

        try {
            $advert = Advert::create([
                'reference' => Str::random(64),
                'description' => $data['description'] ?? null,
                'size' => $data['size'],
                'credit_id' => $credit->id,
                'link' => $data['link'],
                'user_id' => auth()->id(),
                'status' => 'initialized',
            ]);

            $credit->inuse = true;
            $credit->status = 'active';
            $credit->update();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful.',
                'advert' => $advert,
                'redirect' => ''
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again.'
            ]);
        }         
    }

    /**
     * Api [post] edit Advert
     */
    public function edit($id = 0) 
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'size' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'link' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $advert = Advert::where([
            'id' => $id, 
            'user_id' => auth()->id()
        ])->first();

        if (empty($advert)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Advert not found'
            ]);
        }

        try {
            $advert->link = $data['link'];
            $advert->description = $data['description'] ?? null;
            $advert->size = $data['size'];
            $advert->update();

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful.',
                'advert' => $advert,
                'redirect' => ''
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed. Try again.'
            ]);
        } 
    }

    /**
     * Activate advert
     */
    public function activate($id = 0)
    {
        $advert = Advert::find($id);
        if (empty($advert)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation'
            ]);
        }

        $public_id = request()->get('public_id');
        $image = Image::where([
            'type' => 'advert', 
            'public_id' => $public_id, 
            'model_id' => $id
        ])->first();
        
        if(empty($image->link ?? '') || empty($public_id)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Please upload advert image first.'
            ]);
        }
            
        $credit = Credit::find($advert['credit_id']);
        if (empty($credit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation'
            ]);
        }

        $advert->started = Carbon::now();
        $advert->expiry = Carbon::now()->addDays($credit->duration);
        $advert->status = 'active';
        $advert->update();

        $credit->inuse = true;
        $credit->status = 'active';
        $credit->update();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successfull',
            'redirect' => ''
        ]);
    }

    /**
     * Pause advert
     */
    public function pause($id = 0)
    {
        $advert = Advert::find($id);
        if (empty($advert)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation'
            ]);
        }

        $credit = Credit::find($advert['credit_id']);
        if (empty($credit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Credit not found'
            ]);
        }

        $advert->paused_at = Carbon::now();
        $advert->status = 'paused';
        $advert->update();

        $credit->inuse = true;
        $credit->status = 'paused';
        $credit->update();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successfull',
            'redirect' => ''
        ]);
    }

    /**
     * Resume advert
     */
    public function resume($id = 0)
    {
        $advert = Advert::find($id);
        if (empty($advert)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation'
            ]);
        }

        $credit = Credit::find($advert['credit_id']);
        if (empty($credit) || $advert->status !== 'paused') {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation'
            ]);
        }

        $days = Carbon::parse($advert->paused_at)->diffInDays(Carbon::now());
        $expiry = Carbon::parse($advert->expiry)->addDays($days);
        
        $advert->paused_at = null;
        $advert->expiry = $expiry;
        $advert->status = 'active';
        $advert->update();

        $credit->inuse = true;
        $credit->duration = $credit->duration + $days;
        $credit->status = 'active';
        $credit->update();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successfull',
            'redirect' => ''
        ]);
    }

    /**
     * It will delete advert and reverse remaining credits if any
     * The advert image would be deleted from cloudinary
     */
    public function delete($id = 0)
    {
        $advert = Advert::find($id);
        if (empty($advert)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Advert not found'
            ]);
        }

        $credit = Credit::find($advert['credit_id']);
        if (empty($credit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Credit not found.'
            ]);
        }

        $duration = $credit->duration ?? 1;
        $timing = Timing::calculate($duration, $advert->expiry, $advert->started, $advert->paused_at);
        if ($timing->expired()) {
            $credit->delete();
        }else {
            $credit->inuse = false;
            $credit->duration = $timing->daysleft();
            $credit->status = 'available';
            $credit->update();
        }

        if ($advert->delete()) {
            if (!empty($advert->image)) {
                if (!empty($advert->image->public_id)) {
                    Cloudinary::delete([$advert->image->public_id]);
                }
            }

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successfull',
                'redirect' => '',
                'credit' => $credit,
            ]);
        }

        return response()->json([
            'status' => 0, 
            'info' => 'Operation failed. Try again.',
            'credit' => $credit,
        ], 500);
    }

    /**
     * Extend advert expiry
     */
    public function extend($id = 0)
    {
        $advert = Advert::find($id);
        if (empty($advert)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation'
            ]);
        }

        $data = request()->all();
        $validator = Validator::make($data, [
            'expiry' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        if (!in_array($advert->status, ['active', 'expired'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Only active or expired adverts can be extended.'
            ]);
        }

        $advert->expiry = Carbon::parse($data['expiry']);
        $advert->status = 'active';
        $advert->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successfull',
            'redirect' => ''
        ]);
    }

    /**
     * Adverts sizes
     */
    public function sizes()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successfull',
            'sizes' => Advert::$sizes,
        ]);
    }

}