<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use \Exception;


class Visitor
{

	/**
	 * Query visitor data
	 */
	public static function lookup()
	{
		try {
            $response = Http::withHeaders([
                'x-rapidapi-host' => 'ip-geo-location.p.rapidapi.com',
                'x-rapidapi-key' => env('RAPID_API_KEY')
            ])->get('https://ip-geo-location.p.rapidapi.com/ip/check', [
                'format' => 'json',
            ]);

            if ($response->failed()) {
            	return [
            		'status' => 0,
            		'info' => (array)$response->json(),
            	];
            }

            $result = (array)$response->json();
            if (strtolower($result['status']) === 'ok') {
            	return [
            		'status' => 1,
            		'info' => 'Request successfull',
            		'data' => $result
            	];
            }

            return [
        		'status' => 0,
        		'info' => 'Invalid request. Try again'
        	];
        } catch (Exception $error) {
            return [
        		'status' => 0,
        		'info' => 'An error occured. Try again later'
        	];
        }
	}

    /**
     * Get visitor data by ip address
     */
    public static function iplookup($ip = '')
    {
        try {
            $response = Http::withHeaders([
                'x-rapidapi-host' => 'ip-geo-location.p.rapidapi.com',
                'x-rapidapi-key' => env('RAPID_API_KEY')
            ])->get('https://ip-geo-location.p.rapidapi.com/ip', [
                'format' => 'json',
                'ip' => $ip
            ]);

            if ($response->failed()) {
                return [
                    'status' => 0,
                    'info' => 'Request failed. Try again'
                ];
            }

            $result = (array)$response->json();
            if (strtolower($result['status'] ?? '') === 'ok') {
                return [
                    'status' => 1,
                    'info' => 'Request successfull',
                    'data' => $result
                ];
            }

            return [
                'status' => 0,
                'info' => 'Invalid request. Try again'
            ];
        } catch (Exception $error) {
            return [
                'status' => 0,
                'info' => 'An error occured. Try again later'
            ];
        }
    }

}