<?php

namespace App\Http\Controllers\Api;
use App\Models\Content;
use App\Http\Controllers\Controller;
use \Exception;
use Validator;

class ContentsController extends Controller
{

    /**
     * Add page content
     */
    public function add()
    {
        if (request()->user()->cannot('create', ['contents'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Sorry. You cannot perform this operation.'
            ]);
        }

        $data = request()->all();
        $validator = Validator::make($data, [
            'content' => ['required', 'string'],
            'section' => ['required', 'integer'],
            'page' => ['required', 'string'],
            'title' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $section = Content::where([
            'page' => $data['page'],
            'section' => $data['section'],
        ])->first();

        if (!empty($section)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Page section already added. Just edit it.',
                'redirect' => '',
            ]);
        }

        Content::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'section' => $data['section'],
            'page' => $data['page'],
            'status' => $data['status'] ?? 'active',
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => '',
        ]);     
    }

    /**
     * Edit page section content
     */
    public function edit($id = 0)
    {
        if (request()->user()->cannot('update', ['contents'])) {
            return response()->json([
                'status' => 0, 
                'info' => 'Sorry. You cannot perform this operation.'
            ]);
        }

        $data = request()->all();
        $validator = Validator::make($data, [
            'content' => ['required', 'string'],
            'section' => ['required', 'integer'],
            'page' => ['required', 'string'],
            'title' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        // $sections = Content::where([
        //     'page' => $data['page'],
        //     'section' => $data['section'],
        // ])->get();

        // foreach ($sections as $section) {
        //     if (!empty($section) && $id !== $section->id) {
        //         return response()->json([
        //             'status' => 0, 
        //             'info' => 'Page section already added.',
        //             'redirect' => '',
        //         ]);
        //     }
        // }
            

        $content = Content::find($id);
        if (empty($content)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid operation',
            ]);
        }

        $content->title = $data['title'];
        $content->content = $data['content'];
        $content->section = $data['section'];
        $content->page = $data['page'];
        $content->status = $data['status'] ?? 'active';
        $content->user_id = auth()->id();
        $content->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => '',
        ]);     
    }

}