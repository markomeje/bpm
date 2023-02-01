<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\{Subscription, Membership, Payment};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use \Exception;
use \Carbon\Carbon;
use Validator;


class SubscriptionController extends Controller
{
    /**
     * Activate subscription after payment
     */
    public function activate($id = 0)
    {
        $data = request()->only(['payment_id']);
        $validator = Validator::make($data, [
            'payment_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $payment_id = $data['payment_id'];
        $payment = Payment::find($payment_id);
        if (empty($payment)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Payment not found.',
            ]);
        }

        if ($payment->status !== 'paid') {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid payment',
            ]);
        }

        $plan = Membership::find($payment->product_id);
        if (empty($plan)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid membership plan',
            ]);
        }

        $duration = $plan->duration ?? 0;
        $now = Carbon::now();
        $subscription = Subscription::create([
            'started' => $now->format('Y-m-d H:i:s'),
            'expiry' => $now->addDays($duration)->format('Y-m-d H:i:s'),
            'user_id' => auth()->id(),
            'reference' => (string)Str::uuid(),
            'membership_id' => $plan->id,
            'duration' => $duration,
            'status' => 'active',
            'payment_id' => $payment_id,
        ]);

        if (empty($subscription)) {
            return response()->json([
                'status' => 0, 
                'info' => 'An error occured. Try again.'
            ]);
        }

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'subscription' => $subscription
        ]);
    }

    /**
     * renew subscription
     *
     * @return \Illuminate\Http\Response
     */
    public function renew() {
        $data = request()->only(['payment_id', 'subscription_id', 'membership_id']);
        $validator = Validator::make($data, [
            'payment_id' => ['required', 'integer'],
            'subscription_id' => ['required', 'integer'],
            'membership_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        // try {
            $payment = Payment::where(['id' => $data['payment_id']])->first();
            if (empty($payment)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid payment.'
                ]);
            }

            $plan_id = $data['membership_id'];
            $plan = Membership::find($plan_id);
            if (empty($plan)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid plan.'
                ]);
            }

            $duration = $plan->duration;
            $subscription = Subscription::where(['id' => $data['subscription_id']])->first();
            if (empty($subscription)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid subscription.'
                ]);
            }

            // Check previous remaining days and add to the renewal if any
            $remainingdays = Carbon::parse($subscription->expiry)->diffInDays($now)->format('Y-m-d H:i:s');
            $totaldays = $duration + ($remainingdays <= 0 ? 0 : $remainingdays);

            $subscription->expiry = $now->addDays($totaldays)->format('Y-m-d H:i:s');
            $subscription->duration = $totaldays;
            $subscription->renewals = $subscription->renewals + 1;
            $subscription->membership_id = $plan_id;
            $subscription->payment_id = $data['payment_id'];
            if($subscription->update()) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Operation successful'
                ]);
            }

            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed.'
            ]);
        // } catch (Exception $error) {
        //     return response()->json([
        //         'status' => 0,
        //         'info' => 'Unknown error. Try again.'
        //     ]);
        // }    
            
    }


}



