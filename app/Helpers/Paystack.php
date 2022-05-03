<?php

namespace App\Helpers;
use Yabacon\Paystack as Yabacon;
use Yabacon\Paystack\Exception\ApiException;
use Illuminate\Support\Facades\Log;


class Paystack {
    
    /**
     * @var object
     */
	public $paystack;

    /**
     * Call paystack 
     */
	public function __construct() {
		$this->paystack = new Yabacon(env('PAYSTACK_SECRET_KEY'));
	}

	public function initialize($data = []) {
        try{
            return $this->paystack->transaction->initialize($data);
        } catch(ApiException $error){
            Log::error($error->getMessage());
            return false;
	    }
    }

    public function verify($reference = '') {
        try{
            return $this->paystack->transaction->verify(['reference' => $reference]);
        } catch(ApiException $error){
        	Log::error($error->getMessage());
            return false;
	    }
    }

}