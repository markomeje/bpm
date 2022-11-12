<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class Redfin 
{
    /**
     * Timeout for call
     */
    private static $timeout = 180;

    /**
     * @redfin
     * List all properties
     */
	public static function properties($params = []) {
        try{
            $response = Http::withHeaders([
                'X-RapidAPI-Key' => env('X_RAPID_API_KEY'),
                'X-RapidAPI-Host' => env('X_RAPID_API_REDFIN_HOST'),
            ])->timeout(self::$timeout)->accept('application/json')->get('https://unofficial-redfin.p.rapidapi.com/properties/list', $params);

            if ($response->failed()) {
                return [
                    'status' => 0,
                    'properties' => null,
                    'error' => $response->json()
                ];
            }

            $data = $response->json();
            return [
                'status' => 1,
                'properties' => $data['homes'] ?? null,
            ];
        } catch(Exception $error){
            Log::error($error->getMessage());
            return [
                'status' => 0,
                'properties' => null,
                'error' => $error->getMessage()
            ];
	    }
    }

    /**
     * @redfin
     * Get property agent
     */
    public static function agent($propertyId = 0, $listingId = 0) 
    {
        try{
            $params = ['propertyId' => $propertyId, 'listingId' => $listingId];
            $response = Http::withHeaders([
                'X-RapidAPI-Key' => env('X_RAPID_API_KEY'),
                'X-RapidAPI-Host' => env('X_RAPID_API_REDFIN_HOST'),
            ])->timeout(self::$timeout)->accept('application/json')->get('https://unofficial-redfin.p.rapidapi.com/properties/get-agent', $params);

            if ($response->failed()) {
                return [
                    'status' => 0,
                    'agent' => null,
                    'error' => $response->json()
                ];
            }

            $data = $response->json();
            return [
                'status' => 1,
                'agent' => $data,
            ];
        } catch(Exception $error){
            Log::error($error->getMessage());
            return [
                'status' => 0,
                'agent' => null,
                'error' => $error->getMessage()
            ];
        }
          
    }

}