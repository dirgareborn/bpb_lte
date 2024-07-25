<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    use HasFactory;
    
    public function byKategori($slug)
    {
        $kategoriLayanan  = DB::table('categories')->where('url', $slug)->first();
        $page_title       = $kategoriLayanan->category_name;
        $page_description = $kategoriLayanan->description;

        $layanans = Product::with('locations')->where('category_id', $kategoriLayanan->id)->simplePaginate(12);
        // dd($layanan);
        return view('front.byCategory', compact(['page_title', 'page_description', 'layanans', 'kategoriLayanan']));
    }

    public function detailProduk($kategori, $produk)
    {
        $kategoriLayanan  = DB::table('categories')->where('url', $kategori)->first();
        dd($kategoriLayanan);
        $product          = Product::with('images')->where('url', $produk)->first();
        $page_title       = '';
        $page_description = $kategoriLayanan->description;

        return view('front._detailProduct', compact(['page_title', 'page_description', 'product', 'kategoriLayanan']));
    }

    public function _filterByCategory($category_filter, $location_filter)
    {
        
        if (request()->category_filter or request()->location_filter) {
            $resultCategory = request()->category_filter;
            $resultLocation = request()->location_filter;
            $products = Product::wherein(['category_id', $resultCategory,'location_id',$resultLocation])->with(['image'])->get();
        } else {
            $products = Product::with(['image'])->get();
        }
        $categories = Category::whereHas('products')->get();
        
        $page_title       = $products->name;
        $page_description = $categories->description;

        return view('pages.web._detailProduct', compact(['page_title', 'page_description', 'product', 'kategoriLayanan']));
    }

}