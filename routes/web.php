<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\UserController;
use App\Models\Category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Front Route
Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/', [IndexController::class,'index'])->name('beranda');

    // Listing Categories Route
   $catUrls = Category::select('url')->where('status',1)->get()->pluck('url');
    foreach($catUrls as $key => $url){
        Route::get($url,'ProductController@listing');
    } 

    //Product Detail
    Route::get('product/{id}','ProductController@detail');

    // Product Search
    Route::get('search-products','ProductController@listing');
    
    // Add To Cart
    Route::post('/add-to-cart','ProductController@addToCart');
    Route::get('/cart','ProductController@Cart');
    Route::get('/cart/delete-cart-item/{id?}','ProductController@deleteItem');
	
	Route::post('/apply-coupon','ProductController@applyCoupon');
	Route::match(['get','post'],'/checkout','ProductController@checkout');
	
	Route::get('/order-success','ProductController@orderSuccess');
	Route::get('/daftar-pesanan','OrderController@orders');
	
	//customer
	Route::get('/account','UserController@account');
	Route::get('/profil','UserController@profil');
	Route::match(['get','post'],'update-password','UserController@updatePassword');
    Route::post('update-detail','UserController@updateDetail');
    Route::post('check-current-password','UserController@checkCurrentPassword');
	
	// Page
    Route::get('/visi-misi', [IndexController::class,'visiMisi'])->name('visi-misi');
    Route::get('/kontak-kami', [IndexController::class,'kontak'])->name('kontak-kami');
    Route::get('/struktur-organisasi', [IndexController::class,'strukturOrganisasi'])->name('struktur-organisasi');

    Route::post('newsletter/store','App\Http\Controllers\Admin\NewsletterController@store');
});
Auth::routes();
// User Route
Route::get('/akun', [UserController::class, 'index'])->name('akun');

// Admin Route
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get','post'],'login','AdminController@login');
    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard','AdminController@dashboard');
        Route::match(['get','post'],'update-password','AdminController@updatePassword');
        Route::match(['get','post'],'update-detail','AdminController@updateDetail');
        Route::post('check-current-password','AdminController@checkCurrentPassword');
        Route::get('logout','AdminController@logout');


        // Rout CMS
        Route::get('cms-pages','CmsController@index');
        Route::post('update-cms-page-status','CmsController@update');
        Route::match(['get','post'],'add-edit-cms-page/{id?}','CmsController@edit');
        Route::get('delete-cms-page/{id?}','CmsController@destroy');
        
        // Subadmins
        Route::get('subadmins','AdminController@subadmins');
        Route::post('update-subadmin-status','AdminController@updateSubadminStatus');
        Route::match(['get','post'],'add-subadmin/{id?}','AdminController@edit');
        Route::get('delete-subadmin/{id?}','AdminController@deleteSubAdmin');

        // Roles Permissions
        Route::match(['get','post'],'update-role/{id?}','AdminController@updateRole');
    
        // Categories
        Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status','CategoryController@updateStatus');
        Route::get('delete-category/{id?}','CategoryController@deleteCategory');
        Route::get('delete-category-image/{id?}','CategoryController@deleteCategoryImage');
        Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@edit');

        // Products
        Route::get('products', 'ProductController@products');
        Route::post('update-product-status','ProductController@updateStatus');
        Route::get('delete-product/{id?}','ProductController@deleteProduct');
        Route::get('delete-product-image/{id?}','ProductController@deleteProductImage');
		
        Route::get('delete-product-image-slide/{id?}','ProductController@deleteProductImageSlide');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductController@edit');

        // Banners
        Route::get('banners', 'BannerController@banners');
        Route::post('update-banner-status','BannerController@updateStatus');
        Route::get('delete-banner/{id?}','BannerController@deleteBanner');
        Route::get('delete-banner-image/{id?}','BannerController@deleteBannerImage');
        Route::match(['get','post'],'add-edit-banner/{id?}','BannerController@edit');
		
		// Account Bank
		Route::get('account-banks', 'AccountBankController@accountbanks');
        Route::post('update-account-bank-status','AccountBankController@updateStatus');
        Route::get('delete-account-bank/{id?}','AccountBankController@deleteAccountBank');
        Route::get('delete-account-bank-icon/{id?}','AccountBankController@deleteAccountBankImage');
        Route::match(['get','post'],'add-edit-account-bank/{id?}','AccountBankController@edit');
		
		// Coupons
        Route::get('coupons', 'CouponController@coupons');
        Route::post('update-coupon-status','CouponController@updateStatus');
        Route::get('delete-coupon/{id?}','CouponController@deletCoupon');
        Route::match(['get','post'],'add-edit-coupon/{id?}','CouponController@edit');
		
        // Customer
        Route::get('customers', 'UserController@users');
		
		// Orders 
		Route::get('/orders','OrderController@orders');
		Route::get('/order-details/{id}','OrderController@orderDetails');
		Route::get('/edit-order/{id}','OrderController@edit');
    });
});

