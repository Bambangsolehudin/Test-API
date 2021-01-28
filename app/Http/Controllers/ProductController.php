<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::all();

        return response()->json([
                'status' => 'success',
                'data' => $product
        ]);

    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }
// 
    public function create(Request $request) {
        
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'categories_id' => 'required|integer',
            'quantity' => 'required|integer',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $category_id = Category::find($request->categories_id);
        
        if (!$category_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 404);
        }

 

        $product =  Product::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);

    }

    public function update(Request $request, $id) {
        
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'categories_id' => 'required|integer',
            'quantity' => 'required|integer',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $category_id = Category::find($request->categories_id);
        
        if (!$category_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 404);
        }

        $product = Product::find($id);
       
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ], 404);
        }


        $product->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    public function destroy($id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ], 404);
        }

        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'product deleted'
        ]);

    }
    
}
