<?php

namespace App\Http\Controllers\Api;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Helpers\Cloudinary;
use \Carbon\Carbon;
use \Exception;
use Validator;

class BlogsController extends Controller
{

    public function status($id)
    {
        $blog = Blog::find($id);
        $status = (boolean)request()->post('status');
        if($status === true && empty($blog->image)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Upload blog image first.',
            ]);
        }

        $blog->published = $status;
        $blog->update();
        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function store()
    {
        if (request()->user()->cannot('create', ['blogs'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Sorry. You cannot perform this operation.'
            ]);
        }

        $data = request()->all();
        $validator = Validator::make($data, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $published = (boolean)$data['status'] ?? false;
        if($published === true) {
            return response()->json([
                'status' => 0, 
                'info' => 'You can publish the post only after uploading an image. Select No.',
            ]);
        }

        $blog = Blog::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'published' => $published,
            'user_id' => auth()->id(),
            'reference' => Str::random(64),
        ]);

        if ($blog) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route('admin.blog.edit', ['id' => $blog->id]),
            ]);
        }
         
        return response()->json([
            'status' => 0, 
            'info' => 'Operation failed',
        ]);   

    }

    public function edit($id = 0)
    {
        if (request()->user()->cannot('update', ['blogs'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Sorry. Operation not allowed.'
            ]);
        }

        $data = request()->all();
        $validator = Validator::make($data, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $blog = Blog::find($id);
        if (empty($blog)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation. Try Again.',
            ]);
        }

        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->category = $data['category'];
        $blog->published = (boolean)($data['status'] ?? false);
        $blog->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation Successful',
            'redirect' => route('admin.blogs'),
        ]);

    }

    /*
     * Api delete blog with its images
     */
    public function delete($id = 0)
    {
        $blog = Blog::find($id);
        if(empty($blog)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation',
            ]);
        }

        try {
            if (!empty($blog->image)) {
                Cloudinary::delete($blog->image()->pluck('public_id')->toArray());
            }

            $blog->delete();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => '',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 1, 
                'info' => 'Unknown error. Try again later',
            ]);
        }
            
    }

}