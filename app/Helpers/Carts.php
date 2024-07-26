<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

function totalCartItems(){
    if(Auth::check()){
        $user_id = Auth::user()->id;
        $totalCartItems = Cart::where('user_id',$user_id)->sum('qty');
    }else{
        $session_id = Session::get('session_id');
        $totalCartItems = Cart::where('session_id',$session_id)->sum('qty');
    }
    return $totalCartItems;
}

function getCartItems(){
    if(Auth::check()){
        $user_id = Auth::user()->id;
        $getCartItems = Cart::with('product')->where('user_id',$user_id)->get()->toArray();
    }else{
        $session_id = Session::get('session_id');
        $getCartItems = Cart::with('product')->where('session_id',$session_id)->get()->toArray();
    }
    return $getCartItems;
}