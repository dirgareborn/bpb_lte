<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;
use App\Models\Location;
use App\Models\ProfilWebsite;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $profil;
    public function __construct()
    
    {
        $this->profil     = ProfilWebsite::first();
        // dd($this->profil);
        $MenuCategories = Category::getCategories();
        $category = Category::where('status', 1)->orderBy('category_name','ASC')->get();
        $locations = Location::orderBy('name','ASC')->get();
        $galery = Product::select('product_image','url')->limit(6)->get()->toArray();
        // dd($galery);
        
        View::share([
            'profil'                 => $this->profil,
            'MenuCategories'             => $MenuCategories,
            'categories'             => $category,
            'locations'              => $locations,
            'galery'              => $galery
        ]);
    }
}
