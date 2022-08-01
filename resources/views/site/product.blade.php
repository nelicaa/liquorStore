@extends('site.layouts.layout')
@section("title", "Product")
@section("page", "Product")
@section("content")
    <section class="">
        <div class="container">
            <div class="row p-5">
                <div class="col-lg-6 mb-5 ">

                    <a href="#"  class="image-popup prod-img-bg"><img id="image{{$product->id}}" src="{{asset("assets/images/products/".$image)}}" class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5">
                    <h3>{{$product->name}}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">

                        <p class="text-left">
                            <span class="" id="sold" >- {{$sold[0]->order_sum_quantity}} </span><span  class="text-danger"> SOLD</span>
                        </p>
                    </div>
                    <div id="priceDiscount">
                        @if($productLiter[0]->discount!=0)
                            <small class="price text-decoration-line-through">${{$productLiter[0]->price}}</small>
                            <p  class="price "><span class="text-danger">${{$productLiter[0]->price-($productLiter[0]->price*$productLiter[0]->discount/100)}}</span></p>
                            <small class="">Discount : <span class="text-danger text-bold">{{$productLiter[0]->discount}} %</span></small>
                        @else
                            <p class="price"><span>${{$productLiter[0]->price}}</span></p>

                        @endif


                    </div>


                    <h4>{{$product->desc}}</h4>
                    <div class="row mt-4">
                        <div class="input-group col-md-6 d-flex mb-3">
<span class="input-group-btn mr-2">

</span>
{{--                                         {{dd(session()->get("cart"))}}--}}
{{----}}
{{--<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">--}}
{{--<i class="fa fa-plus"></i>--}}
{{--</button>--}}
</span>
                        </div>

                        <small class="">All available measure for this product </small>

                    @foreach($product->liter as $l)
                            <div class="col-sm-2 img-fluid mb-5 mt-3">
{{--{{dd($l->id)}}--}}
                                <span class="text-danger">{{$l->liter}} liter</span>
                                <a href="#" data-product="{{$product->id}}" data-liter="{{$l->id}}" class="showProduct"><img src="{{asset("assets/images/products/".$l->pivot->image)}}" class="img-fluid" alt="Colorlib Template"></a>
                            </div>
                        @endforeach
                        @if(session()->has("user"))
                            @if(session('mess'))
                                <p class="alert-info alert">{{session("mess")}}</p>
                            @endif
                        <small class="text-info">Quantity</small>
<form method="post" action="/cart">
    @csrf
                            <input type="text" id="quantity" name="quantity" class="quantity form-control input-number col-sm-3" value="1" min="1">
                            <input type="hidden" id="price" name="price" class="quantity form-control input-number col-sm-3" value="{{$productLiter[0]->id}}" min="1">
                            <input type="hidden" id="pivot" name="pivot" class="quantity form-control input-number col-sm-3" value="{{$productLiter[0]->product_liter_id}}" min="1">
{{--                            <span class="input-group-btn ml-2">--}}
                        <p class="mt-2 "><input type="submit"  class="btn btn-primary py-3 px-5 mr-2" value="Add to Cart"/></p>
                        @endif
{{--                        <a href="cart.html" class="btn btn-primary py-3 px-5">Buy now</a></p>--}}</form>
                </div>
            </div>

        </div>
    </section>
@endsection

@section("script")
    <script src="{{asset("assets/js/showOneProduct.js")}}"></script>
@endsection
