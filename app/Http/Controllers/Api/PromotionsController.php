<?php

namespace App\Http\Controllers\Api;
use App\Models\{Credit, Property, Material, Profile, Promotion};
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \Carbon\Carbon;
use \Exception;
use Validator;
use DB;

class PromotionsController extends Controller
{
    /**
     * Api promote any product
     */
    public function promote()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'credit' => ['required'],
            'model_id' => ['required'],
            'type' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $type = $data['type'] ?? '';
        if (!in_array($type, Promotion::$types)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid promotion type.',
            ]);
        }

        $credit = Credit::find($data['credit']);
        if (empty($credit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Credit not found.',
            ]);
        }

        if ($credit->status === 'active' || $credit->inuse === true) {
            return response()->json([
                'status' => 0, 
                'info' => 'Credit already in use.',
            ]);
        }

        try {
            DB::beginTransaction();
            $credit->status = 'active';
            $credit->inuse = true;
            $credit->update();

            $days = $credit->duration ?? 0;
            $model_id = $data['model_id'] ?? 0;
            $promotion = Promotion::create([
                'credit_id' => $credit->id,
                'duration' => $days,
                'started' => Carbon::now(),
                'type' => $data['type'],
                'expiry' => Carbon::now()->addDays($days),
                'status' => 'active',
                'user_id' => auth()->id(),
                'reference' => Str::random(64),
                'model_id' => $model_id,
            ]);
            
            if($type === 'property') {
                $property = Property::find($model_id);
                if (!empty($property)) {
                    $property->promoted = true;
                    $property->update();
                }
            }

            DB::commit();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => '',
                'promotion' => $promotion,
            ]);
            
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed',
            ]);
        }
    }

    /**
     * Adverts types
     */
    public function types()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successfull',
            'types' => Promotion::$types,
        ]);
    }
}