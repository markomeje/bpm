<?php

namespace App\Http\Controllers\Api;
use App\Models\{Unit, Payment};
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Helpers\Paystack;
use \Exception;
use Validator;

class CreditsController extends Controller
{
    /**
     * Buy ads credit
     */
    public function buy()
    {
        $data = request()->only(['unit']);
        $validator = Validator::make($data, [
            'unit' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $unit = Unit::find($data['unit']);
        if (empty($unit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Unit not found.'
            ]);
        }

        try {
            $amount = $unit->price ?? 0;
            $reference = (string)Str::uuid();

            $payment = Payment::create([
                'reference' => $reference,
                'amount' => $amount,
                'product_id' => $unit->id,
                'type' => 'adverts',
                'status' => 'initialized',
                'user_id' => auth()->id(),
            ]);

            $type = request()->get('type');
            if ($type === 'mobile') {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Please wait . . .',
                    'payment' => $payment,
                ]);
            }

            $paystack = (new Paystack())->initialize([
                'amount' => $amount * 100, //in kobo
                'email' => auth()->user()->email, 
                'reference' => $reference,
                'currency' => 'NGN',
                'callback_url' => route(request()->subdomain().'.credits')
            ]);

            if ($paystack) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Please wait . . .',
                    'redirect' => $paystack->data->authorization_url,
                    'payment' => $payment
                ]);
            }
            
            return response()->json([
                'status' => 0, 
                'info' => 'Payment initialization failed. Try again.',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'An error occured. Try again.'
            ], 500); 
        }         
    }

}