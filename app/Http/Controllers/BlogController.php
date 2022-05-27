<?php

namespace App\Http\Controllers;
use App\Models\{Category, Blog};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    /**
     * 
     */
    public function index($category = '')
    {
        SEOTools::setTitle('Best Property Market | Blog');
        $blogs = empty($category) ? Blog::latest('created_at')->where(['published' => true])->paginate(18) : Blog::latest('created_at')->where(['category' => Str::title(str_replace('-', ' ', $category)), 'published' => true])->paginate(18);
        return view('frontend.blog.index')->with(['blogs' => $blogs]);
    }

    /**
     * 
     */
    public function read($id = 0, $slug = '')
    {
        $blog = Blog::findOrFail($id);
        SEOTools::setTitle($blog->title);
        return view('frontend.blog.read')->with(['blog' => $blog, 'blogs' => Blog::paginate(14)]);
    }

}
