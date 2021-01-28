<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category; 

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::with('products')->get();

        return response()->json([
                'status' => 'success',
                'data' => $category
        ]);

    }

    public function show($id)
    {
        $category = Category::with('products')->find($id);
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => '$category not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    public function create(Request $request) {
        
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = $request->all();

        $category =  category::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);

    }

    public function update(Request $request, $id) {
        
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = category::with('products')->find($id);
       
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 404);
        }

        $data = $request->all();

        $category->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    public function destroy($id) {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 404);
        }

        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'category deleted'
        ]);

    }
}
