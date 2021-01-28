<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Transaction;
use App\Product;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transaction = Transaction::all();

        return response()->json([
                'status' => 'success',
                'data' => $transaction
        ]);

    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $transaction
        ]);
    }

    public function create(Request $request) { 
        $rules = [
            'uuid' => 'required|unique:transactions|max:255',
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'address' => 'required',
            'transaction_total'=> 'required|integer',
            'transaction_status' => 'required'
        ];


        $data = $request->all();
        $validator = Validator::make($data, $rules);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }



        $transaction =  Transaction::create($data);


        return response()->json([
            'status' => 'success',
            'data' => $transaction
        ]);

    }

    public function update(Request $request, $id) {
        
        $rules = [
            'uuid' => 'required|unique:transactions|max:255',
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'address' => 'required',
            'transaction_total'=> 'required|integer',
            'transaction_status' => 'required'

        ];


        $data = $request->all();
        $validator = Validator::make($data, $rules);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $transaction = Transaction::find($id);
       
        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'transaction not found'
            ], 404);
        }


        $transaction->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $transaction
        ]);
    }

    public function destroy($id) {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'transaction not found'
            ], 404);
        }

        $transaction->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'transaction deleted'
        ]);

    }
}
