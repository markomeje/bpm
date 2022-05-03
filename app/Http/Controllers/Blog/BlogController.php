<?php

namespace App\Http\Controllers\Blog;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use Validator;

class BlogController extends Controller
{
    /**
     * Bogs list view
     */
    public function index($category = '')
    {
        $limit = 15;
        $blogs = empty($category) ? Blog::latest()->paginate($limit) : Blog::where(['category' => \Str::title(str_replace('-', ' ', $category))])->paginate($limit);
        return view('blog.index')->with(['blogs' => $blogs, 'category' => \Str::title(str_replace('-', ' ', $category))]);
    }

    /**
     * Blog add
     */
    public function add()
    {
        return view('blog.add')->with(['blogs' => Blog::paginate(4)]);
    }

    /**
     * Blog edit
     */
    public function edit($id = 0)
    {
        return view('blog.edit')->with(['blog' => Blog::find($id), 'blogs' => Blog::paginate(4)]);
    }

    /**
     * view Blog bg category
     */
    public function category($category)
    {
        return view('blog.category')->with(['blogs' => Blog::where(['category' => \Str::title(str_replace('-', ' ', $category))])->paginate(15), 'category' => \Str::title(str_replace('-', ' ', $category))]);
    }

}
