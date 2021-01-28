<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

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

    public function create(Request $request) {
        
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'categories_id' => 'required',
            'quantity' => 'required',
        ]);

        $category_id = Category::find($request->categories_id);
        
        if (!$category_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 404);
        }

        $data = $request->all();

        $product =  Product::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);

    }

    public function update(Request $request, $id) {
        
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'categories_id' => 'required',
            'quantity' => 'required',
        ]);

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

        $data = $request->all();

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
