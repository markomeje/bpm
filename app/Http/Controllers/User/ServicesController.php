<?php

namespace App\Http\Controllers\User;
use App\Models\Service;
use App\Http\Controllers\Controller;


class ServicesController extends Controller
{
	/**
     * User services list view
     */
    public function index()
    {
        return view('user.services.index')->with(['services' => Service::where(['user_id' => auth()->id()])->paginate()]);
    }

}