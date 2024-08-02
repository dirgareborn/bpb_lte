<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;

    // public static function getCartItems(){
    //     if(Auth::check()){
    //         $user_id = Auth::user()->id;
    //         $getCartItems = Cart::with('product')->where('user_id',$user_id)->get()->toArray();
    //     }else{
    //         $session_id = Session::get('session_id');
    //         $getCartItems = Cart::with('product')->where('session_id',$session_id)->get()->toArray();
    //     }
    //     return $getCartItems;
    // }

    public function product(){
        return $this->belongsTo(Product::class,'product_id')->with('images','categories');
    }
    public static function productBooked($product_id,$booked){
        $productBooked = Cart::where(['product_id'=>$product_id,'start_date'=>$booked])->first();
        return $productBooked;
    }
}
