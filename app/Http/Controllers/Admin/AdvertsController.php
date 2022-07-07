<?php

namespace App\Http\Controllers\Admin;
use App\Models\Advert;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;

class AdvertsController extends Controller
{
    /**
     * Admin countries page view
     */
    public function index($status = '')
    {
        SEOMeta::setTitle('All Adverts');
        $status = request()->get('status');
        $adverts = empty($status) ? Advert::latest()->paginate(24) : Advert::where(['status' => strtolower($status)])->latest()->paginate(18);
        return view('admin.adverts.index')->with(['adverts' => $adverts]);
    }

}
