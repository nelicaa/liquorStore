<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductInsertRequest;
use App\Models\Category;
use App\Models\Liter;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductLiter;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isJson;

class ProductController extends MyController
{
    /**
     * Display a listing of the resource.
     *Fsum
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::with(['category','liter','price'])->get();

        return view("admin.products", ["products"=>$products]);
    }

    public function showProducts(){
        $category=Category::all();
        $liters=Liter::all();
        $products=Product::with(['category','liter','price'])->paginate(2);
        return view("site.products",["menu"=>$this->menu, "cat"=>$category, "products"=>$products, "liters"=>$liters]);
    }

    public function showOne($id, Request $request){

            $idPL=ProductLiter::where([["product_id",$id],["liter_id", $request->input('idL')]])->first("id");
            $product=Product::find($id);
            $productLiter=$product->literOneProduct($idPL->id)->get();

        $product=Product::with(['category','price', 'liter'])->find($id);
        $image=$productLiter[0]->product_liter_id;
        $image=ProductLiter::find($image)->image;
        $sold=Price::where("product_liter_id",$productLiter[0]->product_liter_id)->withSum('order',"quantity")->get();
            return json_encode(["product"=>$product, "productLiter"=>$productLiter ,"image"=>$image, "sold"=>$sold]);;

    }

    public function showProduct($id){
        $idP=ProductLiter::find($id)->product_id; //jedino razlicito
        $product=Product::find($idP);
        $productLiter=$product->literOneProduct($id)->get();
        $product=Product::with(['category','price', 'liter'])->find($idP);
        $image=$productLiter[0]->product_liter_id;
        $image=ProductLiter::find($image)->image;
//            $sold=Price::with('order')->where("product_liter_id",$productLiter[0]->product_liter_id)->get();
        $sold=Price::where("product_liter_id",$productLiter[0]->product_liter_id)->withSum('order',"quantity")->get();
//            if($sold[0]->order_sum_quantity==null){
//                $sold=0;
//            }
        return view("site.product", ["menu"=>$this->menu, "product"=>$product, "productLiter"=>$productLiter ,"image"=>$image,
            "sold"=>$sold
        ]);

    }

public $cat;
public $search;
public $sort;
public $liter;

    public function filterSort(Request $request){
    $this->cat=$request->input("cat");
    $this->liter=$request->input("liter");
    $this->search=$request->input("search");
    $this->sort=$request->input("sort");
    $products=ProductLiter::with(['category','liter','price', 'product'])->
        whereHas('product', function ($i){
            if($this->search!=""){
                $i->where("products.name","like","%".$this->search."%");
            }
            if($this->cat!=""){
                if($this->cat!=""){

                    $i->whereIn("products.category_id", $this->cat); }
            }
    })->
        whereHas("liter", function($i){
            if($this->liter!=""){
                $i->whereIn('liters.id', $this->liter);}
    })
 ->

        paginate(4);

    return json_encode($products);



}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $liters=Liter::all();
        $category=Category::all();
        return view("admin.insertProduct", ["cat"=>$category, "liter"=>$liters]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductInsertRequest $request)
    {
        $priceLiter=json_decode($request->input("objPriceLiter"));
        try{
            \DB::beginTransaction();
           Product::create($request->except("objPriceLiter","image"));
            $productId=Product::all("id")->last();

            foreach ($priceLiter as $i){
                if($request->hasFile("image".$i->idLiter)){
                    $image=$request->file("image".$i->idLiter)->getClientOriginalName();
                    $image=time().$image;
                }
            else{$image=$request->input("image".$i->idLiter);}
             $productLiter=ProductLiter::create(["product_id"=>$productId->id, "liter_id"=>$i->idLiter, "image"=>$image]);
             $productLiterId=ProductLiter::all("id")->last();
             if($productLiter && $request->hasFile("image".$i->idLiter)){
                 $request->file("image".$i->idLiter)->move(public_path("assets/images/products/"),$image);
             }
             Price::create(["discount"=>$i->discount, "price"=>$i->price, "product_liter_id"=>$productLiterId->id]);
            }

            \DB::commit();
        }
        catch (Exception $e){
            \DB::rollBack();
            return $e->getMessage();
    }

        return json_encode(['status'=>true,"url"=>url('/productsAdmin')]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product=Product::with(['category','liter','price'])->find($id);
        $category=Category::all();
        $litersDistinct=Liter::all()->diff($product->liter);
        $liters=Liter::all();
        return view("admin.updateProduct", ["product"=>$product, "cat"=>$category, "liter"=>$liters, "literDistinct"=>$litersDistinct]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductInsertRequest $request, $id)
    {
        $product=Product::where("id",$id)->first();
        $priceLiter=json_decode($request->input("objPriceLiter"));

        try{
            \DB::beginTransaction();
            $product->name=$request->input("name");
            $product->desc=$request->input("desc");
            $product->category_id=$request->input("category_id");
            $product->save();

            foreach ($priceLiter as $i){

                if($request->hasFile("image".$i->idLiter)){
                    $image=$request->file("image".$i->idLiter)->getClientOriginalName();
                    $image=time().$image;
                }
                else{$image=$request->input("image".$i->idLiter);}

                $productLiter = ProductLiter::updateOrCreate(
                    ['product_id' => $product->id, 'liter_id' => $i->idLiter],
                    ['product_id' => $product->id, 'liter_id' => $i->idLiter,'image' => $image]
                )->id;

                if($productLiter && $request->hasFile("image".$i->idLiter)){
                    $request->file("image".$i->idLiter)->move(public_path("assets/images/products/"),$image);
                }
                $price=Price::where("discount",$i->discount)->where("price",$i->price)->where("product_liter_id",$productLiter)->first();
//                return json_encode($productLiter);
                if($price==null){
                    Price::where("product_liter_id",$productLiter)->delete();
                Price::create(["discount"=>$i->discount, "price"=>$i->price, "product_liter_id"=>$productLiter]);
                }
            }

            \DB::commit();
        }
        catch (Exception $e){
            \DB::rollBack();
            return $e->getMessage();
        }
//        return json_encode(['status'=>true,"url"=>url('/productsAdmin')]);
        return json_encode( ["url"=>url('/productsAdmin')]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   try{
        \DB::beginTransaction();
        $productId=ProductLiter::find($id)->product_id;
        $productLiter=ProductLiter::find($id)->delete();
        $price=Price::where("product_liter_id", $id)->delete();
        $product=ProductLiter::where("product_id",$productId)->get();
        if(count($product)==0){
           Product::find($productId)->delete();
        }
        \DB::commit();
        $products=Product::with(['category','liter','price'])->get();
        return json_encode(['status'=>true,"url"=>url('/productsAdmin'),"products"=>$products]);
    }
    catch(Exception $e){
        \DB::rollBack();
        return $e->getMessage();
    }


    }
}
