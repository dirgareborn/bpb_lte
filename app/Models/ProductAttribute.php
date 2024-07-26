<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    
    use HasFactory;
    // public static function productBooked($product_id,$booked){
    //     $productBooked = ProductAttribute::where(['product_id'=>$product_id,'booked'=>$booked])->first();
    //     return $productBooked;
    // }
}
