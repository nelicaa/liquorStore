<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use App\Models\ProductLiter;
use Illuminate\Http\Request;

class HomeController extends MyController
{
    public function index(){
        $products=Product::with(['category','liter','price'])->take(9)->get();

        return view("site.home", ["menu"=>$this->menu,"products"=>$products]);
    }
    public function about(){

        return view("site.about", ["menu"=>$this->menu]);
    }



}
