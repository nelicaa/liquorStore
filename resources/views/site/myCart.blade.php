@extends('site.layouts.layout')
@section("title", "My cart")
@section("page", "CartController")
@section("content")
{{--    {{dd($products)}}--}}
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
{{--                        {{dd($total)}}--}}
                        <tr>
                            <th>&nbsp;</th>
{{--                            <th>&nbsp;</th>--}}
                            <th>Product</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Quantity</th>
                            <th>total</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
@if(empty($products))
    <h1>No products in cart</h1>
    @endif
@if(session('mess'))
    <p class="alert-danger alert">{{session("mess")}}</p>
    @endif

                        @foreach($products as $p)
                        <tr class="alert" role="alert">

                            <td class="col-xs-3">
                                <img class="img img-thumbnail " src="{{asset("assets/images/products/".$p->image)}}"></td>

                            <td>
                                <div class="email">
                                    <span>{{$p->product->name}}</span>
                                    <span>{{$p->product->desc}}</span>
                                </div>
                            </td>
                            <td>$ {{$p->price[0]->price}}</td>
                            <td>{{$p->price[0]->discount}} %</td>

                            <td class="quantity">
{{--                                <div class="input-group">--}}
                                    @foreach(session()->get("cart")["products"] as $c)
                                           @if($c["price_id"]==$p->price[0]->id)
                                            <p>   {{$c["quantity"]}}</p>
                                               @break
                                            @endif
                                        @endforeach

                            </td>
                            <td>
                                {{$p->price[0]->price-($p->price[0]->price*$p->price[0]->discount/100)}} $

                            </td>
                            <td>
                                <a href="/deleteCart/{{$p->price[0]->id}}" class="btn btn-danger" >DELETE</a>

</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>${{$total}}</span>
                        </p>

                        <p class="d-flex">
                            <span>Discount</span>
                            <span>${{$discount}}</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>${{  $totalWithDiscount}}</span>
                        </p>
                    </div>
                    <p class="text-center"><a href="/store" class="btn btn-primary py-3 px-4">Buy</a></p>
                </div>
            </div>
        </div>
    </section>

@endsection
