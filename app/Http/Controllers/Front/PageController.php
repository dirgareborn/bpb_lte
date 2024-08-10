<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use App\Models\Banner;
use App\Models\ProfilWebsite;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route; 
class PageController extends Controller
{

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function show(CmsPage $url){
        $url = Route::getFacadeRoot()->current()->uri;
        $pageCount = CmsPage::where(['url'=>$url,'status'=>'Ready'])->count();
        if($pageCount>0){
            $cmspageDetail = CmsPage::cmspageDetails($url);
            // dd($cmspageDetail);
            return view('front.pages.page')->with(['cmspageDetail' => $cmspageDetail]);
        }else{
            abort(404);
        }

    }
	
	    public function index(){
        $homeSliderBanners = Banner::where('type','Slider')->where('status',1)->orderBy('sort','ASC')->get()->toArray();
        $products = Product::with('images','locations','categories')->where('status',1)->orderBy('id','Desc')->get()->toArray();
        $getTestimonial = Testimonial::with('user')->where('status',1)->get()->toArray();
        $meta_title = 'BPB UNM';
        $meta_description = '';
        return view('front.index')->with(compact('homeSliderBanners','products','getTestimonial','meta_title'));
    }

		public function visiMisi(){
			$visimisi = ProfilWebsite::first();
			$page_title       = 'Hubungi Kami';
			return view('front.pages.visi-misi', compact('visimisi','page_title'));
		}
		public function strukturOrganisasi(){
			$strukturOrganisasi = ProfilWebsite::first();
			$page_title       = 'Struktur Organisasi';
			return view('front.pages.struktur-organisasi', compact('strukturOrganisasi','page_title'));

		}
		public function kontak(){
			$kontak = ProfilWebsite::first();
			$page_title       = 'Kontak Kami';
			return view('front.pages.contact', compact('kontak','page_title'));
		}
		
		public function faq(){
			//$kontak = ProfilWebsite::first();
			$page_title       = 'Pertanyaan Umum';
			return view('front.pages.faq', compact('page_title'));
		}
}
