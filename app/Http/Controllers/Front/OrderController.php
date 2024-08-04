<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders(){
		$orders = Order::with('orders_products')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get()->toArray();
		
		return view('front.orders.order_list')->with(compact('orders'));
	}
}
