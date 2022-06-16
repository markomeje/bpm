<?php

namespace App\Http\Controllers;
use App\Models\{Category, Blog};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;

class BlogController extends Controller
{
    /**
     * 
     */
    public function index($category = '')
    {
        SEOMeta::setDescription('Our blog page shares information on related topics both personal and non-personal. It contains discreet information about anything in the real estate industry which in many cases will benefit our users.');

        if(empty($category)) {
            SEOMeta::setTitle('Our Blogs');
            return view('frontend.blog.index')->with(['blogs' => Blog::published()->latest('created_at')->paginate(18)]);
        }else {
            $category = str_replace('-', ' ', $category);
            SEOMeta::setTitle(ucwords($category).' Blogs');
            return view('frontend.blog.index')->with(['blogs' => Blog::published()->latest('created_at')->where(['category' => $category])->paginate(18), 'category' => $category]);
        }
    }

    /**
     * Read blog view
     */
    public function read($id = 0, $slug = '')
    {
        $blog = Blog::find($id);
        if (empty($blog)) {
            return view('frontend.blog.read')->with(['blog' => '', 'blogs' => Blog::paginate(14)]);
        }

        SEOMeta::setTitle(ucwords($blog->title));
        SEOMeta::setDescription(\Str::limit($blog->description, 205));
        return view('frontend.blog.read')->with(['blog' => $blog, 'blogs' => Blog::paginate(14)]);
    }

}
