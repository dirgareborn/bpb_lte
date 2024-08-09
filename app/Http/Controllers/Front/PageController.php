<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
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
}
