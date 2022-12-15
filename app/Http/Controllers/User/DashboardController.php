<?php

namespace App\Http\Controllers\User;
use App\Models\{Subscription, Unit, Payment, Property, Membership, Credit};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\Paystack;
use \Exception;
use \Carbon\Carbon;


class DashboardController extends Controller
{
    /**
     * Dashboard page view
     */
    public function index()
    {
        $id = auth()->id();
        $reference = request()->get('reference');
        $properties = Property::latest('created_at')->where(['user_id' => $id])->paginate(4);
        return view('user.dashboard.index')->with(['properties' => $properties, 'subscription' => Subscription::where(['user_id' => $id])->first(), 'units' => Unit::all(), 'reference' => $reference, 'verify' => $this->verify($reference), 'credits' => Credit::where(['user_id' => $id])->get()]);
    }

    /**
     * Verify subscription payment transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($reference = '') {
        if(empty($reference)) {
            return [
                'status' => 0,
                'info' => 'Invalid payment verification'
            ];
        }

        DB::beginTransaction();
        $payment = Payment::where(['reference' => $reference])->first();
        if (empty($payment)) {
            return [
                'status' => 0,
                'info' => 'Invalid payment transaction'
            ];
        }elseif (strtolower($payment->status) === 'paid') {
            return [
                'status' => 1,
                'info' => 'Payment already verified.'
            ];
        }

        try {
            $verify = (new Paystack())->verify($reference);
            if (empty($verify) || $verify === false) {
                return [
                    'status' => 0,
                    'info' => 'Verification failed.'
                ];
            }

            $amount = (int)$payment->amount ?? 0;
            if ('success' === $verify->data->status && 'NGN' === strtoupper($verify->data->currency) && $verify->data->customer->email === auth()->user()->email && ((int)$verify->data->amount/100) === $amount) {

                $payment->status = 'paid';
                $payment->update();
                $now = Carbon::now();

                $paymentid = $payment->id ?? 0;
                $subscription = Subscription::where(['reference' => $reference])->first();
                $plan_id = $payment->product_id ?? 0;
                $plan = Membership::find($plan_id);
                $duration = $plan->duration ?? 0;
                
                if (empty($subscription)) { // ie it's a new subscription
                    Subscription::create([
                        'started' => $now->format('Y-m-d H:i:s'),
                        'expiry' => $now->addDays($duration)->format('Y-m-d H:i:s'),
                        'user_id' => auth()->id(),
                        'reference' => $reference,
                        'membership_id' => $plan_id,
                        'duration' => $duration,
                        'status' => 'active',
                        'payment_id' => $paymentid,
                    ]);
                }else {
                    // Check previous remaining days and add to the renewal if any
                    $remainingdays = Carbon::parse($subscription->expiry)->diffInDays($now)->format('Y-m-d H:i:s');
                    $totaldays = $duration + ($remainingdays <= 0 ? 0 : $remainingdays);

                    $subscription->expiry = $now->addDays($totaldays)->format('Y-m-d H:i:s');
                    $subscription->duration = $totaldays;
                    $subscription->renewals = $subscription->renewals + 1;
                    $subscription->membership_id = $plan_id;
                    $subscription->payment_id = $paymentid;
                    $subscription->update();
                }

                DB::commit();
                return [
                    'status' => 1,
                    'info' => 'Transaction successful.'
                ];
            }

            $payment->status = 'failed';
            $payment->update();

            DB::commit();
            return [
                'status' => 0,
                'info' => 'Payment verification failed. Refresh you page.'
            ];
        } catch (Exception $error) {
            DB::rollback();
            return [
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ];
        }    
            
    }
}
