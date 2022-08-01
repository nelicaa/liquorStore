@extends('site.layouts.layout')
@section("title", "Products")
@section("page", "All products")
@section("content")

    <section class="ftco-section">
        <div class="container">

            <div class="row">
                <div class="col-md-9 " id="products">
{{--                    {{dd($products)}}--}}
                    @if(session('mess'))
                        <p class="alert-success alert">{{session("mess")}}</p>
                    @endif
                @foreach($products as $p)
                    <div class="border-3 border row mb-2 p-1">
                       <small class="text-decoration-underline">Product name:</small> <h4>{{$p->name}}</h4>
                        <small>Category:<p class="text-danger category">{{$p->category->name}}</p></small>
                    @for($i=0;$i<count($p->liter);$i++)

                        <x-product-component :i="$i" :product="$p" page="products"></x-product-component>
                        @endfor
                    </div>
                    @endforeach

            </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <input class="search-form form-control" id="search"  type="text" value="" placeholder="Search by product name">

                    </div>

                    <div class="sidebar-box ">
                        <div class="categories">
                            <h3>Product Types</h3>
                            <ul class="p-0">
{{--                                <li>--}}
{{--                                    {{dd($cat)}}--}}
                                    @foreach($cat as $c)
                                    <div class="form-check">
                                        <input class="form-check-input cat" type="checkbox" value="{{$c->id}}" id="cat{{$c->id}}">
                                        <label class="form-check-label" for="defaultCheck1">
                                            {{$c->name}}
                                        </label>
                                    </div>

                                @endforeach

                            </ul>
                        </div>
                        <div class="liters mt-3">
                            <h3>Meausere in liters</h3>
@foreach($liters as $l)
                                <div class="form-check">
                                    <input class="form-check-input liter" type="checkbox" value="{{$l->id}}" id="liter{{$l->id}}">
                                    <label class="form-check-label" for="defaultCheck1">
                                        {{$l->liter}} liter
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        </div>
{{--                    <a href="#" id="filter" class="btn btn-outline-dark col-md-12">Filter</a>--}}
                    </div>
                </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul id="pag">
                            @for($i=1;$i<=$products->lastPage();$i++)
                                 {{--                                {{dd(url())}}--}}
                                                         <li><a  href="{{$products->url($i)}}">{{$i}}</a></li>
                                                          @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>





        </section>
@endsection
@section("script")
    <script src="{{asset("assets/js/pagFilter.js")}}"></script>
@endsection

