<?php

namespace App\Http\Controllers\User;
use App\Models\{Unit, Payment, Credit};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify() {
        $data = request()->all();
        $reference = $data['reference'] ?? '';
        
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
            $unitid = $payment->product_id ?? 0;
            $unit = Unit::find($unitid);
            if (empty($unit)) {
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid ads unit'
                ]);
            }

            $type = request()->get('type');
            if ($type === 'mobile') {
                $status = $data['status'] ?? '';
                if($status === 'success') {
                    $payment->status = 'paid';
                    $payment->update();

                    $credit = Credit::create([
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
                        'info' => 'Operation successful',
                        'payment' => $payment,
                        'credit' => $credit,
                    ]);
                }

                $payment->status = $status;
                $payment->update();
                return response()->json([
                    'status' => 0, 
                    'info' => 'Payment verification failed',
                    'payment' => $payment,
                ]);
            }else {
                $verify = (new Paystack())->verify($reference);
                if (empty($verify) || $verify === false) {
                    return response()->json([
                        'status' => 0,
                        'info' => 'Verification failed.'
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
                    'info' => 'Payment verification failed.'
                ]);
            }  
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ]);
        }    
            
    }
}
