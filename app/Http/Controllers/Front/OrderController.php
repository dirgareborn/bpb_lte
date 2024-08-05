<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use PDF;
use App\Models\AccountBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
	public function orders()
	{
		$orders = Order::with('orders_products')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get()->toArray();

		return view('front.orders.order_list')->with(compact('orders'));
	}

	public function orderSuccess()
	{
		if (Session::has('order_id')) {
			Cart::where('user_id', Auth::user()->id)->delete();
			$orders = Order::with('orders_products')->where('user_id', Auth::user()->id)->where('id', Session::get('order_id'))->get()->toArray();
			$banks = AccountBank::where('status', 1)->get()->toArray();
			return view('front.orders.order_success')->with(compact('orders', 'banks'));
		} else {
			return redirect('/cart');
		}
	}

	public function downloadPDF($id)
	{
		$orders = Order::with('orders_products')->where('user_id', Auth::user()->id)->where('id', $id)->get()->toArray();
		$banks = AccountBank::where('status', 1)->get()->toArray();
		$data = ['orders' => $orders,'banks'=> $banks];
		$pdf = PDF::loadView('front.orders.pdf', $data);
		return $pdf->stream();
	}
	public function generatePDF($id)
	{
		$orders = Order::with('orders_products')->where('user_id', Auth::user()->id)->where('id',$id)->get()->toArray();
		$banks = AccountBank::where('status', 1)->get()->toArray();
		$data = ['orders' => $orders,'banks'=> $banks];
		$pdf = PDF::loadView('front.orders.pdf', $data);
		return $pdf->download('INVOICE.pdf');
	}
}
