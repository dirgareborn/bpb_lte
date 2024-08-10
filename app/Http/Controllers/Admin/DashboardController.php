<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminsRole;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function dashboard(){
       Session::put('page','dashboard');
       $categoryCount = Category::get()->count();
       $productCount = Product::get()->count();
       $adminCount = Admin::get()->count();
       $customerCount = User::get()->count();
	   
       $rows = Product::selectRaw('category_name, COUNT(*) AS total')
            ->join('categories', 'categories.id', 'products.category_id')
            ->groupBy('category_name')->get();
       $pie = [];
        foreach ($rows as $row) {
            $pie[] = [
                'name' =>  $row->category_name,
                'y' =>  $row->total,
            ];
        }
        $rows = OrderProduct::selectRaw('MAX(order_date) AS order_date, SUM(qty) AS total')
            ->join('orders', 'orders.id', 'order_products.order_id')
            ->groupByRaw('YEAR(order_date), MONTH(order_date)')->get();
		
/** LINE CHART */
        $line = [];
        foreach ($rows as $row) {
            $line['categories'][] = date('M-Y', strtotime($row->order_date));
            $line['data'][] = $row->total * 1;
        }
        $rows = OrderProduct::selectRaw('category_name, YEAR(order_date) AS order_date, SUM(qty) AS total')
            ->join('orders', 'orders.id', 'order_products.order_id')
            ->join('products', 'products.id', 'order_products.product_id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->groupByRaw('category_name, YEAR(order_date)')->get();

        /** PIE CHART */
        $column = [];
        foreach ($rows as $row) {
            $column['categories'][$row->order_date] = $row->order_date;
            $column['series'][$row->category_name]['name'] = $row->category_name;
            $column['series'][$row->category_name]['data'][$row->order_date] = $row->total * 1;
        }
        foreach ($column['series'] as $key => $val) {
            $column['series'][$key]['data'] = array_values($val['data']);
        }
        $column['categories'] = array_values($column['categories']);
        $column['series'] = array_values($column['series']);		
		//echo "<pre>" ; print_r($column) ; die;
        return view('admin.dashboard', compact(['categoryCount','productCount','adminCount','customerCount','pie', 'line', 'column']));
    }

}
