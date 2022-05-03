<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class TranslationController extends Controller
{
    //
    public function index(Request $request)
    {
        \Session::put('locale', $request->locale);
        return redirect()->back();
    }
}
