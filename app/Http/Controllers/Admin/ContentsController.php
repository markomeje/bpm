<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;


class ContentsController extends Controller
{
    /**
     * Admin Contents view
     */
    public function index()
    {
        return view('admin.contents.index')->with(['contents' => Content::latest()->paginate(14)]);
    }
}
