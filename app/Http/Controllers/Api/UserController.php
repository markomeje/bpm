<?php

namespace App\Http\Controllers\Api;
use App\Models\{Advert, Credit, Property, Payment, Service, Certification, Material, Profile, User, Subscription, Package};
use App\Http\Controllers\Controller;
use \Exception;


class UserController extends Controller
{
    /**
     * All user adverts
     */
    public function subscription()
    {
        $subscription = Subscription::with(['membership'])->where(['user_id' => auth()->id()])->first();
        if (empty($subscription)) {
            return response()->json([
                'status' => 0, 
                'info' => 'No subscription found',
                'subscription' => null,
            ]);  
        }

        $timing = \App\Helpers\Timing::calculate($subscription->duration, $subscription->expiry, $subscription->started);
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'subscription' => $subscription,
            'package' => $subscription->membership->package,
            'timing' => ['expired' => $timing->expired(), 'daysleft' => $timing->daysleft(), 'progress' => $timing->progress()]
        ]);      
    }

	/**
     * All user adverts
     */
    public function adverts()
    {
        $limit = request()->get('limit');
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'adverts' => Advert::latest('created_at')->with(['image'])->where(['user_id' => auth()->id()])->paginate($limit ?? 14),
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
            'properties' => Property::latest('created_at')->with(['images', 'promotion'])->where(['user_id' => auth()->id()])->get(),
        ]);      
    }

    /**
     * All user credits
     */
    public function credits()
    {
        $credits = Credit::latest('created_at')->where(['user_id' => auth()->id()]);
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'credits' => $credits->get(),
            'available' => $credits->where(['status' => 'available', 'inuse' => false])->get(),
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
            'services' => auth()->user()->services,
            'user' => auth()->user(),
            'profile' => auth()->user()->profile
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
        $profile = Profile::with(['image'])->where(['user_id' => auth()->id()])->first();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'profile' => empty($profile) ? [] : $profile,
            'name' => auth()->user()->name,
            'socials' => auth()->user()->socials,
        ]);      
    }

    public function delete($id = 0)
    {
        $user =  User::find($id);
        if (empty($user)) {
            return response()->json([
                'status' => 0, 
                'info' => 'User not found',
            ]);
        }

        $user->status = 'deleted';
        if($user->update() > 0) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'user' => $user,
            ]);
        }
            
        return response()->json([
            'status' => 0, 
            'info' => 'Operation failed',
        ]);
            
    }

}