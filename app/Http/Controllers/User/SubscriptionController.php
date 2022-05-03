<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Subscription, Membership, Payment};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\Paystack;
use \Exception;
use \Carbon\Carbon;
use Validator;


class SubscriptionController extends Controller
{
    /**
     * initialize and Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function initialize()
    {
        $data = request()->only(['plan']);
        $validator = Validator::make($data, [
            'plan' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        try {
            $plan = Membership::find($data['plan']);
            if (empty($plan)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid subscription plan'
                ]);
            }

            /**
             * This method generates a unique super secure cryptographic hash token to use as transaction reference
             * @returns string
             */
            $reference = (string)Str::uuid();
            $amount = $plan->price ?? 0;
            $payment = Payment::create([
                'reference' => $reference,
                'amount' => $amount,
                'product_id' => $plan->id,
                'type' => 'subscription',
                'status' => 'initialized',
                'user_id' => auth()->user()->id,
            ]);

            $paystack = (new Paystack())->initialize([
                'amount' => $amount * 100, //in kobo
                'email' => auth()->user()->email, 
                'reference' => $reference,
                'currency' => 'NGN',
                'callback_url' => route('user.subscription'),
            ]);

            if ($paystack) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Please wait . . .',
                    'redirect' => $paystack->data->authorization_url,
                ]);
            }
            
            return response()->json([
                'status' => 0, 
                'info' => 'Payment initialization failed. Try again.',
            ]);
            
        }catch(Exception $error) {
            return response()->json([
                'status' => 0, 
                'info' => 'Network error. Refresh the page and try again.'
            ]);
        }        
    }

    public function cancel($id = 0)
    {
        $subscription = Subscription::find($id);
        $subscription->status = 'cancelled';
        if ($subscription->update()) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0, 
            'info' => 'An error occured. Try again.'
        ]);
    }

    public function renew($id = 0)
    {
        $data = request()->only(['plan']);
        $validator = Validator::make($data, [
            'plan' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        try {
            $plan = Membership::find($data['plan']);
            if (empty($plan)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid subscription plan'
                ]);
            }

            $subscription = Subscription::find($id);
            if (empty($subscription)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid subscription plan'
                ]);
            }

            $amount = $plan->price ?? 0;
            $planid = $plan->id ?? 0;
            /**
             * This method generates a unique super secure cryptographic hash token to use as transaction reference
             * @returns string
             */
            $reference = (string)Str::uuid();
            DB::beginTransaction();
            $payment = Payment::create([
                'reference' => $reference,
                'amount' => $amount,
                'product_id' => $planid,
                'type' => 'subscription',
                'status' => 'initialized',
                'user_id' => auth()->user()->id,
            ]);

            $subscription->reference = $reference;
            $subscription->membership_id = $planid;
            $subscription->update();

            DB::commit();
            $paystack = (new Paystack())->initialize([
                'amount' => $amount * 100, //in kobo
                'email' => auth()->user()->email, 
                'reference' => $reference,
                'currency' => 'NGN',
                'callback_url' => route('user.dashboard'),
            ]);

            if ($paystack) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Please wait . . .',
                    'redirect' => $paystack->data->authorization_url,
                ]);
            }
            
            return response()->json([
                'status' => 0, 
                'info' => 'Payment initialization failed. Try again.',
            ]);
            
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0, 
                'info' => 'An error occured. Try again.'
            ]);
        }
    }

    public function activate($id = 0)
    {
        $subscription = Subscription::find($id);
        $subscription->status = 'active';
        if ($subscription->update()) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => '',
            ]);
        }

        return response()->json([
            'status' => 0, 
            'info' => 'An error occured. Try again.'
        ]);
    }

}
