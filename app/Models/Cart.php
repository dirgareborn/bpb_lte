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

    public function product(){
        return $this->belongsTo(Product::class,'product_id')->with('images','categories');
    }
    public static function productBooked($product_id,$start,$end){
        $productBooked = Cart::where(['product_id'=>$product_id])
		                     ->whereRaw("start_date <=  $start")
							 ->whereRaw("end_date >=  $end")->first();
        return $productBooked;
    }
}
