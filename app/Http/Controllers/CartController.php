<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductLiter;
use Illuminate\Http\Request;

class CartController extends MyController
{
    public function index(Request $request){
        $newProducts=[];
        $productExists=true;
        if(empty($request->session()->get("cart")["products"])){
            $request->session()->push('cart.products', ["pivot"=>$request->input("pivot"),"price_id"=>$request->input("price"), "quantity"=>$request->input("quantity")]);
        }
        else{
            $products=$request->session()->get("cart")["products"];

            if(count($products)!=0){
                foreach($products as $p){
//                dd($products);

                    if($p["price_id"] == $request->input("price")){
                        $quantity=$p["quantity"]+$request->input("quantity");
                        $newProducts[]= ["pivot"=>$request->input("pivot"),"price_id"=>$request->input("price"), "quantity"=>$quantity];
                        $productExists=false;
                    }
                    else{
                        $newProducts[]=$p;
                    }

                }
                if($productExists){
                    $newProducts[]=["pivot"=>$request->input("pivot"),"price_id"=>$request->input("price"), "quantity"=>$request->input("quantity")];
                }
                $request->session()->put('cart.products',$newProducts);
            }


        }
        return back(201)->with("mess", "Product added to your cart!");
    }

    public function myCart(Request $request){
        $inCart=$request->session()->get("cart.products");
        $inCartId=[];
        $inCartQuantity=[];
        $total=0;
        $discount=0;
        $totalWithDiscount=0;

        foreach ($inCart as $c){
            $inCartId[]=$c["pivot"];
            $inCartQuantity[$c["price_id"]]=$c["quantity"];
        }
//        dd($inCartId);

        $products=ProductLiter::with(["order","product", "price"])->whereIn("id",$inCartId)->get();
//        dd($products);

        foreach ($products as $p){
//            dd($inCartQuantity, $p->price[0]->id);
            $total+=$p->price[0]->price*$inCartQuantity[$p->price[0]->id];
            $discount+=$p->price[0]->price*$p->price[0]->discount/100;
        }
        $totalWithDiscount=$total-$discount;


       return view("site.myCart",['menu'=>$this->menu, "products"=>$products, "total"=> $total, "discount"=>$discount, "totalWithDiscount"=>$totalWithDiscount]);
    }

public function showCartProducts(Request $request){
        $id=$request->input("idCart");
        $orders=Order::with('price')->where("cart_id", $id)->get();
//    $products=ProductLiter::with(["order","product", "price"])->whereIn("id",$orders[0]->price->product_liter_id)->get();
    $products=$orders->map(function ($p){
        $product["product"]=ProductLiter::withTrashed()->with(["order","product", "price"])
            ->where("id",$p->price->product_liter_id)->first();
        $product["quantity"]=$p->quantity;
        return $product;
    });
    return json_encode($products);
}


public function showCart(AdminRequest $request){
        if($request->input("date")!=null){
            $date=$request->input("date");
            $carts=Cart::with('user')->where("created_at", "LIKE", "$date%")->get();
        }
        else{
            $carts=Cart::with('user')->get();
        }
        return json_encode($carts);
}
    public function delete($idPrice, Request $request){
        $products=$request->session()->get("cart")["products"];
        $newProducts=[];
            foreach($products as $p){
                if($p["price_id"] == $idPrice){
                   continue;
                }
                else{
                    $newProducts[]=$p;
                }
    }
        $request->session()->put('cart.products',$newProducts);

        return back()->with("mess", "Successful deleted product.");

    }
    public function store(Request $request){

       $idCart= Cart::create([
            "user_id"=>$request->session()->get("cart")["user_id"]
       ])->id;
       foreach ($request->session()->get("cart")["products"] as $p){
           Order::create([
               "cart_id"=>$idCart,
               "price_id"=>$p["price_id"],
               "quantity"=>$p["quantity"]
           ]);
       }
        $request->session()->forget("cart.products");

        return redirect("products", 201)->with('mess', "You successfully purchased!");
    }
}


