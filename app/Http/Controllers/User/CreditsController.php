<?php

namespace App\Http\Controllers\User;
use App\Models\{Unit, Payment, Credit};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\Paystack;
use \Exception;
use Validator;


class CreditsController extends Controller
{
	/**
     * User credits list view
     */
    public function index()
    {
        $reference = request()->get('reference');
        return view('user.credits.index')->with(['credits' => Credit::latest()->where(['user_id' => auth()->id()])->paginate(12), 'units' => Unit::all(), 'verify' => $this->verify($reference), 'reference' => $reference]);
    }

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
                'info' => 'Invalid operation'
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

            $paystack = (new Paystack())->initialize([
                'amount' => $amount * 100, //in kobo
                'email' => auth()->user()->email, 
                'reference' => $reference,
                'currency' => 'NGN',
                'callback_url' => route('user.credits')
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
            return response()->json([
                'status' => 0, 
                'info' => 'An error occured. Refresh the page and try again.'
            ]);
        }         
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($reference = '') {
        if(empty($reference)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid payment verification'
            ]);
        }

        DB::beginTransaction();
        $payment = Payment::where(['reference' => $reference])->first();
        if (empty($payment)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid payment transaction'
            ]);
        }elseif (strtolower($payment->status) === 'paid') {
            return response()->json([
                'status' => 1,
                'info' => 'Payment already verified.'
            ]);
        }

        try {
            $verify = (new Paystack())->verify($reference);
            if (empty($verify) || $verify === false) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Verification failed.'
                ]);
            }

            $unitid = $payment->product_id ?? 0;
            $unit = Unit::find($unitid);
            if (empty($unit)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid ads unit'
                ]);
            }

            $amount = (int)$payment->amount ?? 0;
            if ('success' === strtolower($verify->data->status) && 'NGN' === strtoupper($verify->data->currency) && $verify->data->customer->email === auth()->user()->email && ((int)$verify->data->amount/100) === $amount) {

                $payment->status = 'paid';
                $payment->update();

                Credit::create([
                    'payment_id' => $payment->id,
                    'duration' => $unit->duration,
                    'unit_id' => $unit->id,
                    'units' => $unit->units,
                    'reference' => $reference,
                    'status' => 'available',
                    'user_id' => auth()->id(),
                ]);

                DB::commit();
                return response()->json([
                    'status' => 1,
                    'info' => 'Transaction successfull.'
                ]);
            }

            $payment->status = 'failed';
            $payment->update();
            return response()->json([
                'status' => 0,
                'info' => 'Payment verification failed. Refresh you page.'
            ]);
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }    
            
    }
}
