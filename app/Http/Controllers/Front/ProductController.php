<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\Coupon;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function listing(){
        $url = Route::getFacadeRoot()->current()->uri;
        $page_title = 'KATEGORI';
        $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
        // dd($categoryCount);
        if($categoryCount>0){
            // get Category Details
            $categoryDetails = Category::categoryDetails($url);
            // Get Category Product
            // dd($categoryDetails);
            $categoryProducts = Product::with('images')->where('category_id',$categoryDetails['catIds'])
            ->where('status',1)->orderBy('id','Desc')->simplePaginate();

            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts','page_title'));
        }else if(isset($_GET['query'])&&!empty($_GET['query'])){
            $search = $_GET['query'];
			$categoryDetails['category_name'] = $search;

			$categoryProducts = Product::with(['images'])->where(function($query)use($search){
				$query->where('product_name','like','%'.$search.'%');
				$query->orwhere('product_description','like','%'.$search.'%');
			})->where('status',1);
			$categoryProducts = $categoryProducts->get();
            // dd($categoryProducts);
			return view('front.products.listing')->with(compact('categoryDetails','categoryProducts','page_title'));
        }else{
            abort(404);
        }
    }
    public function detail($id){
        $productDetails = Product::with(['images','attributes','categories'])->find($id)->toArray();
        return view('front.products.detail')->with(compact('productDetails'));
    }
    public function addToCart(Request $request){
        if($request->isMethod('post')){

			Session::forget('couponAmount');
			Session::forget('couponCode');

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            //Cek Date Booked Status
            $date_booking = Carbon::parse($data['booked'])->format('Y/m/d');
            $isBooked = Cart::productBooked($data['product_id'],$date_booking);

            if($isBooked){
                $message = "Produk Tidak Tersedia ditanggal ".$date_booking;
                return response()->json(['status'=>false,'message'=>$message]);
            }

            // Check Status
            $productStatus = Product::productStatus($data['product_id']);
            if($productStatus == 0){
                $message = "Produk Tidak Tersedia";
                return response()->json(['status'=>false,'message'=>$message]);
            }
            // Generate session ID if not exist
            if(empty(Session::get('session_id'))){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }else{
                $session_id = Session::get('session_id');
            }

            // Check Product if already 
            if(Auth::check()){
                $user_id = Auth::user()->id;
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'start_date'=> $date_booking])->count();
            }else{
                // user is not logged in
                $user_id = 0;
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'start_date'=> $date_booking])->count();
            }
            if($countProducts>0){
                $message = "Produk sudah ada dikeranjang";
                return response()->json(['status'=>false,'message'=>$message]);
            }
            $item = new Cart;
            $item->session_id = $session_id;
            if(Auth::check()){
                $item->user_id = Auth::user()->id;
            }else{
                $item->user_id = 0;
            }
            // $item->user_id = $user_id;
            $item->product_id = $data['product_id'];
            $item->start_date = $date_booking;
            $item->end_date = $date_booking;
            $item->customer_type = $data['customer_type'];
            $item->qty = $data['qty'];
            $item->save();
            $message = "Produk berhasil ditambahkan";
            return response()->json(['status'=>true,'message'=>$message]);
            }
    }
    public function cart(){

		Session::forget('couponAmount');
		Session::forget('grandTotal');
		Session::forget('couponCode');
		$getCartItems = getCartItems();
		
		if(empty(Session::get('session_id'))){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }else{
                $session_id = Session::get('session_id');
        }
		//dd($session_id);
		if(Auth::check()){
            $user_id = Auth::user()->id;
        }else{
            $user_id = 0;
        }
		$getCartCount = Cart::where('session_id',$session_id)->count();
		//dd($getCartCount);
		if($getCartCount>0){
			Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
            $message = "Keranjang berhasil diperbaharui";
            return view('front.products.cart')->with(compact('message','getCartItems'));
        }else{
        return view('front.products.cart')->with(compact('getCartItems'));
		}
    }
	public function applyCoupon(Request $request){
		if($request->ajax()){
			
            $data = $request->all();
			$getCartItems = getCartItems();
			$totalCartItems = totalCartItems();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
			if($couponCount==0){
				return response()->json([
					'status'=>false,
					'totalCartItems'=> $totalCartItems,
					'message'=> 'Kupon tidak ada',
					'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
				]);
			}else{
				$couponDetails = Coupon::where('coupon_code', $data['code'])->first();
				
				if($couponDetails->status==0){
					$error_message = "Kupon sudah tidak aktif";
				}
				$expired_date = $couponDetails->expired_date;
				$current_date = date('Y-m-d');
				if($expired_date<$current_date){
					$error_message = "Kupon sudah Kadaluarsa";
				}
				$prodArr = explode(",", $couponDetails->products);
				$usersArr = explode(",", $couponDetails->users);
				foreach($usersArr as $key => $user){
					$getUserID = User::select('id')->where('email',$user)->first()->toArray();
					$userID[] = $getUserID['id'];
				}
				$total_amount = 0;
				foreach($getCartItems as $key => $item){
					if(!in_array($item['product_id'],$prodArr)){
						$error_message = "Kupon Tidak berlaku untuk produk yang dipilih";
					}
					if(count($usersArr)>0){
						if(!in_array($item['user_id'],$userID)){
							$error_message = "Kupon Ini Tidak berlaku untuk Anda, Silahkan coba menggunakan Kupon lain";
						}
					}
					$getAttributePrice =  Product::getAttributePrice($item['product_id'],$item['customer_type']); 
					$total_amount = $total_amount + ($getAttributePrice['final_price']*$item['qty']);
					
				}
				

				if(isset($error_message)){
					return response()->json([
					'status'=>false,
					'totalCartItems'=> $totalCartItems,
					'message'=> $error_message,
					'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
				]);
				}else{
					if($couponDetails->amount_type=="Fixed"){
						$couponAmount = $couponDetails->amount;
					}else{
						$couponAmount = $total_amount * ($couponDetails->amount/100);
					}
					$grand_total = $total_amount - $couponAmount;
					Session::put('couponAmount',$couponAmount);
					Session::put('grandTotal',$grand_total);
					Session::put('couponCode',$data['code']);
					$message = "Kupo berhasil digunakan, anda mendapatkan potongan harga";
					
					return response()->json([
						'status'=>true,
						'totalCartItems'=> $totalCartItems,
						'couponAmount'=> $couponAmount,
						'grand_total'=> $grand_total,
						'message'=> $message,
						'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
					]);
				}
				
			}
		}
	}
	public function checkout(Request $request){
		
		$getCartItems = getCartItems();
		$snap_token = 0;
		
			
		if(count($getCartItems)==0){
			$message = "Keranjang Masih Kosong, Booking sebelum melakukan checkout!";
			return redirect('cart')->with('error_message',$message);
		}
		if($request->isMethod('post')){
			
            $data = $request->all();
			
			//echo "<pre>"; print_r ($data); die;
			//check Payment Method
			if(empty($data['payment_gateway'])){
				return redirect()->back()->with('error_message','Silahkan Pilih Metode Pembayaran');
			}
			if(!isset($data['agree'])){
				return redirect()->back()->with('error_message','Silahkan Setujui untuk melanjutkan!');
			}
			
			//Payment Cash
			if($data['payment_gateway']=="cash"){
				$payment_method = "cash";
				$order_status ="New";
			}else{
				$payment_method = "Prepaid";
				$order_status ="Pending";
			}
			// Fetch Order Total Price 
			
			$total_price = 0;
            foreach($getCartItems as $item){
				$getAttributePrice = Product::getAttributePrice($item['product_id'],$item['customer_type']);
				$total_price = $total_price + ($getAttributePrice['final_price'] * $item['qty']);	
			}
			
			$grand_total = $total_price - Session::get('couponAmount');
			Session::put('grand_total', $grand_total);
			
			// Insert Order Details
			$order = Order::create([
					'user_id' => Auth::user()->id,
					'name' => $data['name'],
					'email' => $data['email'],
					'address' => $data['address'],
					'mobile' => $data['mobile'],
					'pincode' => $data['pincode'],
					'payment_gateway' => $data['payment_gateway'],
					'payment_method' => $payment_method,
					'grand_total' => $grand_total,
					'coupon_code' => Session::get('couponCode'),
					'coupon_amount' => Session::get('couponAmount'),
					'order_status' => $order_status,
			]);
			$order_id = DB::getPdo()->lastInsertId(); 		
			
			foreach($getCartItems as $key => $item){
				$getProductDetails = Product::getProductDetails($item['product_id']);
				$getAttributeDetails = Product::getAttributeDetails($item['product_id'],$item['customer_type']);
				$getAttributePrice = Product::getAttributePrice($item['product_id'],$item['customer_type']);
				
				$cartItem = new OrderProduct;
				$cartItem->order_id = $order_id;
				$cartItem->user_id = Auth::user()->id;
				$cartItem->product_id = $item['product_id'];
				$cartItem->product_name = $getProductDetails['product_name'];
				$cartItem->product_price = $getAttributePrice['final_price'];
				$cartItem->customer_type = $getAttributeDetails['customer_type'];
				$cartItem->start_date = $item['start_date'];
				$cartItem->end_date = $item['end_date'];
				$cartItem->qty = $item['qty'];
				$cartItem->save();
				
			}
			$order = Session::put('order_id',$order_id);
			DB::commit();
			
			return redirect('/order-success');
		}
		
		//dd($data);
		return view('front.products.checkout')->with(['getCartItems'=>$getCartItems,'snap_token'=>$snap_token]);
	}
    public function deleteItem($id)
    {   
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }else{
            $user_id = 0;
        }
        $session_id = Session::get('session_id');
        $resul =  Cart::where('id',$id)->where('session_id',$session_id)->orWhere('user_id',$user_id)->delete();

        if($resul){

            return redirect()->back()->with('success_message','Item Berhasil dihapus');
        }else{
            return redirect()->back()->with('error_message','Item Gagal dihapus');

        }
    }
}

