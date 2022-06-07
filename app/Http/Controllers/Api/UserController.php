<?php

namespace App\Http\Controllers\Api;
use App\Models\{Advert, Credit, Property, Payment, Service, Certification};
use App\Http\Controllers\Controller;
use \Exception;


class UserController extends Controller
{
	/**
     * All user adverts
     */
    public function adverts()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'adverts' => Advert::with(['image'])->where(['user_id' => auth()->id()])->get(),
        ]);      
    }

    /**
     * All user properties
     */
    public function properties()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'properties' => Property::with(['images'])->where(['user_id' => auth()->id()])->get(),
        ]);      
    }

    /**
     * All user credits
     */
    public function credits()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'credits' => Credit::where(['user_id' => auth()->id()])->get(),
        ]);      
    }

    /**
     * All user payments
     */
    public function payments()
    {
        $limit = 20;
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'payments' => Payment::where(['user_id' => auth()->id()])->paginate($limit),
        ]);      
    }

    /**
     * All user services
     */
    public function services()
    {
        $limit = 20;
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'services' => Service::where(['user_id' => auth()->id()])->paginate($limit),
        ]);      
    }

    /**
     * All user certifications
     */
    public function certifications()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'certifications' => Certification::where(['user_id' => auth()->id()])->get(),
        ]);      
    }

}