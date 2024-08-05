<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function orders(){
		$orders = Order::with('orders_products','users')->orderBy('id','DESC')->get()->toArray();
		//dd($orders);
		return view('admin.orders.orders')->with(compact('orders'));
	}
	
	public function edit($id){
        $order     = Order::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $order
        ], 200);
	}
	
	public function orderDetails($id){
		$orderDetails = Order::with('orders_products','users')->where('id',$id)->first()->toArray();
		dd($orderDetails);
		return view('admin.orders.order_details')->with(compact('orderDetails'));
		
	}
}
