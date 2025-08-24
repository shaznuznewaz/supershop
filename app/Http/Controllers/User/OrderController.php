<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerOrderStoreRequest;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function customerOrderStore(Request $request){
        

       // echo $request->product_id;
/*
        $product=Product::findOrFail($request->product_id);
        if(!$product){
            return response()->json([
                'message'=>'product not found'
            ]);
        }

        return response()->json([
            'message'=>'product found'
        ]);
        */
       $request->validate([
            'product_id' => 'required'
        ]);

        $user = Auth::user();
        
        $product = Product::findOrFail($request->product_id);

        // create order data

        $order = Order::create(
            [
                'user_id' => $user->id,
                'status' => 'pending',
                'total' => $product->price,
            ]
        );

        OrderDetails::create([
            'order_id' => $order->id, 
            'product_id' => $request->product_id, 
            'quantity' => 1, 
            'price' => $product->price, 
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Order placed successfully',
            'order_id' => $order->id,
        ]);
        
    }


    public function adminCustomerOrders(){
        $orders=Order::orderBy('created_at','desc')->get();
        return view('pages.dashboard.admin.orders.order-list-page',compact('orders'));
    }
    
    public function customerOrders(){
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('pages.dashboard.customers.orders.order-list-page',compact('orders'));
    }


}
