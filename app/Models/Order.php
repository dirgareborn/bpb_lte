<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'user_id','name','email','address' ,'mobile','pincode','payment_gateway','payment_method','grand_total','coupon_code' ,'coupon_amount' ,'order_status'
	];
	
	public function orders_products(){
		return $this->hasMany(OrderProduct::class,'order_id');
	}
}