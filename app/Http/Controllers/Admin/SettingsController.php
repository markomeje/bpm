<?php

namespace App\Http\Controllers\Admin;
use App\Models\{Category, Skill, Country};
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Validator;

class SettingsController extends Controller
{
    /**
     * Admin settings list view
     */
    public function index()
    {
        SEOMeta::setTitle('Dasboard Settings');
        return view('admin.settings.index')->with([]);
    }


}
