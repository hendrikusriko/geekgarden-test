<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\models\Cart;
use App\models\Order;
use App\models\OrderDetail;

class OrderController extends Controller
{
    public function checkout() {
        $userId = 1;
        $checkCart = Cart::where('user_id', $userId)->with(['product'])->get();
        $totalPrice = 0;
        do {
            $invoice = 'INV' . rand();
            $invoiceCheck = $data = Order::select('*')->where('invoice_number', $invoice)->first();
        } while ($invoiceCheck);

        if ($checkCart) {
            foreach ($checkCart as $value) {
                $totalPrice += $value->product->price;
            }
            $orderCreate = [
                'invoice_number' => $invoice,
                'user_id' => $userId,
                'total_price' => $totalPrice,
                'order_status' => 'pending'
            ];
    
            
            DB::transaction(function () use($userId, $invoice, $orderCreate, $checkCart) {
                $order = Order::create($orderCreate);

                foreach ($checkCart as $value) {
                    $orderDetailCreate = [
                        'order_id' => $order->id,
                        'product_id' => $value->product->id
                    ]; 
                    OrderDetail::create($orderDetailCreate);
                }
                Cart::where('user_id', $userId)->delete();
            });
            return response()->json(["success" => true,"message" => "All product from your cart has been checkout"]);
        } else {
            return response()->json(["error" => true,"message" => "Cart is empty"]);
        }

    }
}
