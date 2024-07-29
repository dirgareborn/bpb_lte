<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
            dd($search);
        }else{
            abort(404);
        }
    }

    public function detail($id){

        $productDetails = Product::with(['images','attributes','categories'])->find($id)->toArray();
        // dd($productDetails);
        return view('front.products.detail')->with(compact('productDetails'));
    }

    public function addToCart(Request $request){
        if($request->isMethod('post')){
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

        // $getCartItems = Cart::getCartItems();
        $getCartItems = getCartItems();
        // dd($getCartItems);
        return view('front.products.cart')->with(compact('getCartItems'));
    }

    public function deleteItem($id)
    {   
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }else{
            $user_id = 0;
        }
        $session_id = Session::get('session_id');
        $resul =  Cart::where('id',$id)->where('session_id',$session_id)->where('user_id',$user_id)->delete();

        if($resul){

            return redirect()->back()->with('success_message','Item Berhasil dihapus');
        }else{
            return redirect()->back()->with('error_message','Item Gagal dihapus');

        }
    }


}

