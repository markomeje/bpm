<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use \Exception;


class Sms
{

	/**
	 * Send OTP sms
	 */
	public static function otp(array $data)
	{
		try {
            $reference = Str::uuid();
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://app.smartsmssolutions.com/io/api/client/v1/smsotp/send/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => ['token' => env('SMARTSMS_API_TOKEN'), 'phone' => $data['phone'], 'otp' => $data['otp'], 'sender' => 'OTP NG', 'template_code' => '7153792424', 'ref_id' => $reference],
            ]);

            $response = curl_exec($curl);
            if($response === false){
                return [
                    'status' => 0, 
                    'info' => curl_error($curl),
                ];
            }

            curl_close($curl);
            $data = json_decode($response, true);
            $success = $data['success'] ?: false; 
            $comment = $data['comment'] ?: ''; 
            return $success === true ? ['status' => 1, 'info' => 'Request successfull'] : ['status' => 0, 'info' => 'Invalid request. Try again'];

        } catch (Exception $error) {
            return [
        		'status' => 0,
        		'info' => 'An error occured. Try again later'
        	];
        }
	}

}