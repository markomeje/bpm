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
            Advert::create([
                'reference' => Str::random(64),
                'description' => $data['description'],
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
            'credit' => ['required', 'integer'],
            'description' => ['required', 'string'],
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
                'info' => 'Invalid operation'
            ]);
        }

        try {
            $advert->link = $data['link'];
            $advert->description = $data['description'];
            $advert->size = $data['size'];
            $advert->update();

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful.',
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
                'info' => 'Please upload advert image first by clicking the camera icon.'
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
                'info' => 'Invalid operation'
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
     * Renew Advert not ready yet
     */
    public function renew()
    {
        return response()->json([
            'status' => 0, 
            'info' => 'Invalid operation'
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
                'info' => 'Invalid operation'
            ]);
        }

        $credit = Credit::find($advert['credit_id']);
        if (empty($credit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation'
            ]);
        }

        $duration = $credit->duration ?? 1;
        $timing = Timing::calculate($duration, $advert->expiry, $advert->started, $advert->paused_at);
        if ($timing->expired()) {
            $credit->delete();
        }elseif($advert->status !== 'initialized' || $advert->status !== 'expired') {
            $credit->inuse = false;
            $credit->duration = $timing->daysleft();
            $credit->status = 'available';
            $credit->update();
        }

        if (!empty($advert->image)) {
            Cloudinary::delete([$advert->image->public_id]);
        }

        $advert->delete();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successfull',
            'redirect' => ''
        ]);
    }

}