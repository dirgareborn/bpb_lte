<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\UserController;
use App\Models\Category;
use App\Models\CmsPage;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Auth;
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

 Route::get('/sitemap', function () {
    $sitemap = Sitemap::create()
		->add(Url::create('/')
		->setLastModificationDate(Carbon::yesterday())
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(0.1))
		->add(Url::create('/visi-misi'))
		->add(Url::create('/struktur-organisasi'))
		->add(Url::create('/kontak-kami'))
		->add(Url::create('/register'))
		->add(Url::create('/login'))
		->add(Url::create('/tentang-kami'));
		
		$cats = Category::all()->each(function(Category $category) use ($sitemap){
		$url = $category->url;
			$sitemap->add(Url::create('/kategori/'.$url)
			->setLastModificationDate(Carbon::yesterday())
			->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
			->setPriority(0.1));
		});
		$sitemap->writeToFile(public_path('sitemap.xml'));
		return 'susses';
});

// Front Route

Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/', [PageController::class,'index'])->name('beranda');

    // Listing Categories Route
   $catUrls = Category::select('url')->where('status',1)->get()->pluck('url');
    foreach($catUrls as $key => $url){
        Route::get('kategori/'. $url,'ProductController@listing');
    } 
	
	//Category all
    Route::get('kategori', 'CategoryController@category');
	
    //Product Detail
    Route::get('kategori/{category}/{url}','ProductController@detail');

    // Product Search
    Route::get('search-products','ProductController@listing');
    
    // Add To Cart
    Route::post('/add-to-cart','ProductController@addToCart');
    Route::get('/cart','ProductController@Cart');
    Route::get('/cart/delete-cart-item/{id?}','ProductController@deleteItem');
	
	Route::post('/apply-coupon','ProductController@applyCoupon');
	Route::match(['get','post'],'/checkout','ProductController@checkout');
	
	Route::get('/order-success','OrderController@orderSuccess');
	Route::get('/order-invoice-pdf/{id}','OrderController@generatePDF');
	Route::get('/download-invoice-pdf/{id}','OrderController@downloadPDF');
	Route::get('/daftar-pesanan','OrderController@orders');
	
	//customer
	Route::get('/account','UserController@account');
	Route::get('/profil','UserController@profil');
	Route::match(['get','post'],'update-password','UserController@updatePassword');
    Route::post('update-detail','UserController@updateDetail');
    Route::post('check-current-password','UserController@checkCurrentPassword');
    Route::match(['get','post'],'testimonial','UserController@testimonial');

	
	// Page
    Route::get('/visi-misi', [PageController::class,'visiMisi'])->name('visi-misi');
    Route::get('/kontak-kami', [PageController::class,'kontak'])->name('kontak-kami');
    Route::get('/struktur-organisasi', [PageController::class,'strukturOrganisasi'])->name('struktur-organisasi');
    Route::get('/faq', [PageController::class,'faq'])->name('faq');

     // Listing Page Route
    $catUrls = CmsPage::select('url')->where('status','ready')->get()->pluck('url');
    foreach($catUrls as $key => $url){
        Route::get($url,'PageController@show');
    } 
});
Auth::routes();
// User Route
Route::get('/akun', [UserController::class, 'index'])->name('akun');

// Admin Route
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::post('newsletter/store','App\Http\Controllers\Admin\NewsletterController@store');
    Route::match(['get','post'],'login','AdminController@login');
    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard','DashboardController@dashboard')->name('admin.dashboard');
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

