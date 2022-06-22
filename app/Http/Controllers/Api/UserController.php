<?php

namespace App\Http\Controllers\Api;
use App\Models\{Advert, Credit, Property, Payment, Service, Certification, Material, Profile};
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
            'adverts' => Advert::latest('created_at')->with(['image'])->where(['user_id' => auth()->id()])->get(),
        ]);      
    }

    /**
     * All user building materials
     */
    public function materials()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'materials' =>  Material::latest('created_at')->with(['images'])->where(['user_id' => auth()->id()])->get(),
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
            'properties' => Property::latest('created_at')->with(['images'])->where(['user_id' => auth()->id()])->get(),
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
            'credits' => Credit::latest('created_at')->where(['user_id' => auth()->id()])->get(),
        ]);      
    }

    /**
     * All user payments
     */
    public function payments()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'payments' => Payment::latest('created_at')->where(['user_id' => auth()->id()])->get(),
        ]);      
    }

    /**
     * All user services
     */
    public function services()
    {
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'services' => Service::latest('created_at')->where(['user_id' => auth()->id()])->get(),
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

    /**
     * User profile
     */
    public function profile()
    {
        $profile = Profile::where(['user_id' => auth()->id()])->first();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'profile' => empty($profile) ? [] : $profile,
        ]);      
    }

}