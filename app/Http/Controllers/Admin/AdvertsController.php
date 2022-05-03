<?php

namespace App\Http\Controllers\Admin;
use App\Models\Advert;
use App\Http\Controllers\Controller;

class AdvertsController extends Controller
{
    /**
     * Admin countries page view
     */
    public function index($status = '')
    {
        $adverts = empty($status) ? Advert::latest()->paginate(24) : Advert::where(['status' => strtolower($status)])->latest()->paginate(18);
        return view('admin.adverts.index')->with(['adverts' => $adverts]);
    }

}
