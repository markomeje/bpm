<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Exception;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $newsapi = \App\Helpers\News::api($limit = 8, $page);
        //dd($newsapi);
        return view('frontend.news.index')->with(['newsapi' => $newsapi]);
    }

}
