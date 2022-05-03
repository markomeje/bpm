<?php

namespace App\Http\Controllers;
use App\Models\{Category, Blog};
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * 
     */
    public function index($category = '')
    {
        $blogs = empty($category) ? Blog::latest('created_at')->paginate(26) : Blog::latest('created_at')->where(['category' => Str::title(str_replace('-', ' ', $category))])->paginate(26);
        return view('frontend.blog.index')->with(['title' => 'Our Blog', 'blogs' => $blogs]);
    }

    /**
     * 
     */
    public function read($id = 0, $slug = '')
    {
        $blog = Blog::find($id);
        return view('frontend.blog.read')->with(['title' => $blog->title ?? env('APP_NAME'), 'blog' => $blog, 'blogs' => Blog::paginate(26)]);
    }

}
