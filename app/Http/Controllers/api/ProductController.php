<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\Product;

class ProductController extends Controller
{

    public $successStatus = 200;

    public function index() {
        $data = Product::get();
        if ($data) {
            return response()->json(["success" => true,"data" => $data]);
        }
        return response()->json(["error" => true,"message" => "Product not found"]);
    }
    
    public function create(Request $request) {
        $dataCreate = [
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
        ];
        // return $dataCreate;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Product::create($dataCreate);
        return response()->json(["success" => true,"message" => "New product has been created"]);
    }

    public function update($id, Request $request) {
        $checkData = Product::where('id', $id)->first();
        if (!$checkData) return response()->json(["error" => true,"message" => "Product data not found"]);

        $dataUpdate = [
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
        ];
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        Product::where('id', $id)->update($dataUpdate);;
        return response()->json(["success" => true,"message" => "Product has been updated"]);
    }

    public function delete($id)
    {   
        $checkData = Product::where('id', $id)->first();
        if (!$checkData) return response()->json(["error" => true,"message" => "Product data not found"]);
        
        Product::where('id', $id)->delete();
       
        return response()->json(['message' => 'Product has been deleted']);
    }
}
