<?php

namespace App\Http\Controllers\Admin;
use App\Models\{Category, Property, Country};
use App\Http\ControllerS\Controller;
use Validator;

class CategoriesController extends Controller
{
    /**
     * Admin Properties home view
     */
    public function index()
    {
        return view('admin.categories.index')->with(['allCategories' => Category::all()]);
    }

    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        foreach(Category::all()->toArray() as $category) {
            if (($category['name'] == $data['name']) && ($category['type'] == $data['type'])) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Category name already exists for the selected type'
                ]);
            }
        }

        Category::create([
            'name' => $data['name'],
            'type' => $data['type'],
        ]);

        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function edit($id)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        foreach(Category::all()->toArray() as $category) {
            if (($category['name'] == $data['name']) && ($category['type'] == $data['type']) && $category['id'] !== $id) {
                return response()->json([
                    'status' => 0,
                    'info' => 'Category name already exists for the selected type'
                ]);
            }
        }

        $category = Category::find($id);
        $category->name = $data['name'];
        $category->type = $data['type'];
        $category->update();

        return response()->json([
            'status' => 1,
            'info' => 'Operation successful',
            'redirect' => ''
        ]);
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return response()->json([
            'status' => 1,
            'info' => 'Operation successful'
        ]);
    }

}
