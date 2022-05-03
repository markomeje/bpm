<?php

namespace App\Http\Controllers\Admin;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use Validator;

class BlogsController extends Controller
{
    /**
     * Admin Bogs list view
     */
    public function index($category = '')
    {
        $limit = 15;
        $blogs = empty($category) ? Blog::latest()->paginate($limit) : Blog::where(['category' => \Str::title(str_replace('-', ' ', $category))])->paginate($limit);
        return view('admin.blogs.index')->with(['blogs' => $blogs, 'category' => \Str::title(str_replace('-', ' ', $category))]);
    }

    /**
     * Admin Blog add
     */
    public function add()
    {
        return view('admin.blogs.add')->with(['blogs' => Blog::paginate(4)]);
    }

    /**
     * Admin Blog edit
     */
    public function edit($id = 0)
    {
        return view('admin.blogs.edit')->with(['blog' => Blog::find($id), 'blogs' => Blog::paginate(4)]);
    }

    /**
     * Admin view Blog bg category
     */
    public function category($category)
    {
        return view('admin.blogs.category')->with(['blogs' => Blog::where(['category' => \Str::title(str_replace('-', ' ', $category))])->paginate(15), 'category' => \Str::title(str_replace('-', ' ', $category))]);
    }

}
