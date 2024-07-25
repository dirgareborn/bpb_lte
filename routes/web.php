<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\ProductController;
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
    // Add To Cart
    Route::post('/add-to-cart','ProductController@addToCart');

    Route::get('/visi-misi', [IndexController::class,'visiMisi'])->name('visi-misi');
    Route::get('/struktur-organisasi', [IndexController::class,'strukturOrganisasi'])->name('struktur-organisasi');

});

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
    });
});
