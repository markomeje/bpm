<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Membership, Payment};
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \Exception;
use Validator;


class PaymentController extends Controller
{
    /**
     * @mobile only endpoint
     */
    public function initialize()
    {
        $data = request()->only(['product_id', 'type']);
        $validator = Validator::make($data, [
            'product_id' => ['required', 'integer'],
            'type' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        try {
            $type = $data['type'];
            switch ($type) {
                case 'subscription':
                    $product = Membership::find($data['product_id']);
                    if (empty($product)) {
                        return response()->json([
                            'status' => 0, 
                            'info' => 'Invalid Subscription Plan'
                        ]);
                    }
                    break;
                
                default:
                    return response()->json([
                        'status' => 0, 
                        'info' => 'Invalid Operation'
                    ]);
                    break;
            }
            
            $payment = Payment::create([
                'reference' => (string)Str::uuid(),
                'amount' => $product->price,
                'product_id' => $product->id,
                'type' => $type,
                'status' => 'initialized',
                'user_id' => auth()->user()->id,
            ]);
            
            if (empty($payment)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Payment initialization failed. Try again.',
                ]);
            }

            return response()->json([
                'status' => 1, 
                'info' => 'Operation successfull',
                'payment' => $payment,
            ]);
            
        }catch(Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'Network error. Try again.'
            ]);
        }        
    }

    public function status($id = 0) {
        $data = request()->only(['status']);
        if (!in_array(($data['status'] ?? ''), Payment::$status)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid Status Sent.',
                'statuses' => Payment::$status,
            ]);
        }

        $payment = Payment::find($id);
        if (empty($payment)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid Payment.'
            ]);
        }

        $payment->status = strtolower($data['status']);
        if($payment->update()) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'payment' => $payment,
            ]);
        }

        return response()->json([
            'status' => 0, 
            'info' => 'Operation Failed. Try Again.'
        ]);
    }

}