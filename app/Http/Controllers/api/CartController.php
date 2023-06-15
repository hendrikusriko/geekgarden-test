<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\Cart;
use App\models\User;
use App\models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $userId = 1;
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $checkCart = Cart::where([
                        ['product_id', $request->input('product_id')],
                        ['user_id', $userId]
                    ])->first();
        if ($checkCart) return response()->json(["error" => true,"message" => "This product is already in your cart"]);

        $dataCreate = [
            'user_id' => $userId,
            'product_id' => $request->input('product_id'),
        ];

        Cart::create($dataCreate);
        return response()->json(["success" => true,"message" => "Product has been added to cart"]);
    }

    public function listCart() {
        $userId = 1;
        $data = Cart::with(['product'])->where('user_id', $userId)->get();
        if ($data) {
            foreach ($data as $value) {
                $result[] = [
                    'name' => $value['product']->name,
                    'price' => $value['product']->price,
                    'category' => $value['product']->category,
                ];
            }
            return response()->json(["success" => true,"data" => $result]);
        }
        return response()->json(["error" => true,"message" => "Cart is empty"]);
    }
}
