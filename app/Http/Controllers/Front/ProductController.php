<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function listing(){
        $url = Route::getFacadeRoot()->current()->uri;
        $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
        if($categoryCount>0){
            // echo "Category exists";

            // get Category Details
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);
            
            // Get Category Product
            $categoryProducts = Product::with('locations','categories','images')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1)->orderBy('id','DESC')->get()->toArray();
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }else{
            abort(404);
        }
    }

    public function detail($id){

        $productDetails = Product::with(['images','categories'])->find($id)->toArray();
        // dd($product);
        return view('front.products.detail')->with(compact('productDetails'));
    }

    public function addToCart(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $date_booking = Carbon::createFromFormat('d/m/Y H:i|', request('date_booking'));
            $isBooked = DB::table('product_attributes')
            ->where('product_id', request('product_id'))
            ->whereDate('start_date', '=', $date_booking)
            ->exists();
            dd($isBooked);
            if($isBooked){
                $message = "Produk Tidak Tersedia ditanggal ".$data['date_booking'];
                return response()->json(['status'=>false,'message'=>$message]);
            }else{
                $message = "Produk Tersedia ditanggal ".$data['date_booking'];
                return response()->json(['status'=>true,'message'=>$message]);
            }
        }
    }
}
