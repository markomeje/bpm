<?php

namespace App\Http\Controllers\Api;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
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

        Blog::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'published' => $published,
            'user_id' => auth()->id(),
            'reference' => Str::random(64),
        ]);

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => route('admin.blogs'),
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
        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->category = $data['category'];
        $blog->published = (boolean)$data['status'];
        $blog->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation Successful',
            'redirect' => route('admin.blogs'),
        ]);

    }

}