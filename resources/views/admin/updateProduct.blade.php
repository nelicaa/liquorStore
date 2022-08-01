@extends("admin.layouts.layout")
@section("title", "Update products")
@section("page", "Update product")
@section("content")

    <section class="content">
        <div class="row">
            <!-- left column -->
            <form role="form"  enctype="multipart/form-data" method="POST">
                @csrf
                @method("put")
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name product</label>
                        <input type="text" class="form-control" id="name"  value="{{$product->name}}" placeholder="Name product">
                        <small class="border-bottom border-danger text-danger d-none nameError"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <input type="text" class="form-control" id="desc" value="{{$product->desc}}" placeholder="Description">
                        <small class="border-bottom border-danger text-danger d-none descError"></small>
                    </div>
                </div>


                <div class="form-group">
                    <label>Category</label>
                    <select id="cat" class="form-control">
                        @foreach($cat as $c)
                            @if($c->id == $product->category->id)
                                <option selected value="{{$c->id}}">{{$c->name}}</option>
                                @continue
                            @endif
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>



                <h3>Measure, price and discount for this product</h3>
                <div class="row justify-content-start">
                    {{--                    <h3>Measure, price and discount for this product</h3>--}}

                    <p class="border-bottom border-danger text-danger d-none priceError"></p>
                    @for($i=0;$i<count($product->liter);$i++)

                        <div class="col-lg-6 col-md-12 ">
                            <div class="input-group ">
                                <small class="">Measure</small>
                                <p class="text-bold measure text-info">{{$product->liter[$i]->liter}} liter</p>
                                <div class="form-group">
                                    <small for="price" class="">Price</small>
                                    <input type="text" value="{{$product->price[$i]->price}}" id="{{$product->liter[$i]->id}}" class="form-control price">
                                    <p class="border-bottom border-danger text-danger d-none priceError{{$product->liter[$i]->id}}"></p>
                                </div>
                                <div class="form-group">
                                    <small for="disc" class="form-check-label">Discount</small>
                                    <input type="text"  value="{{$product->price[$i]->discount}}" class="form-control disc{{$product->liter[$i]->id}}">
                                    <p class="border-bottom border-danger text-danger d-none discError{{$product->liter[$i]->id}}"></p>

                                </div>
                                <div class="form-data">
                                    <img class="img img-responsive col-xs-5 col-sm-3 col-md-5 m-3" src="{{asset("assets/images/products/".$product->liter[$i]->pivot->image)}}">

                                    <input type="file"name="picture{{$product->liter[$i]->id}}" value="{{$product->liter[$i]->pivot->image}}" class="mt-4 picture{{$product->liter[$i]->id}}" >

                                    <small class="border-bottom border-danger text-danger d-none picError{{$product->liter[$i]->id}}"></small>

                                    <p class="help-block">Insert picture for this product for {{$product->liter[$i]->liter}} liter </p>

                                </div>

                            </div><!-- /input-group -->

                            {{--                        <div class="form-group col-xs-10 col-sm-7 col-md-5 pb-3">--}}
                            {{--                    <img class="img img-responsive col-xs-5 col-sm-3 col-md-5 m-3" src="{{asset("assets/images/person_3.jpg")}}">--}}
                            {{--                            <p for="exampleInputFile">Insert image for this measure</p>--}}

                            {{--                        </div>--}}
                        </div><!-- /.col-lg-6 -->
                    @endfor
                    <h4 class="text-decoration-underline text-bold">New mesaures availabale</h4>

                    @foreach($literDistinct as $l)

                        <div class="col-lg-6 col-md-12">
                            <div class="input-group ">
                                <small class="">Measure</small>
                                <p class="text-bold measure text-info"> {{$l->liter}} liter</p>
                                <div class="form-group">
                                    <small for="price" class="">Price</small>
                                    <input type="text" value="" placeholder="price" id="{{$l->id}}" class="form-control price">
                                    <p class="border-bottom border-danger text-danger d-none priceError{{$l->id}}"></p>
                                </div>
                                <div class="form-group">
                                    <small for="disc" class="form-check-label">Discount</small>
                                    <input type="text"  value="" placeholder="discount for this price" class="form-control disc{{$l->id}}">
                                    <p class="border-bottom border-danger text-danger d-none discError{{$l->id}}"></p>

                                </div>
                                <div class="form-data">
                                    <input type="file" name="picture{{$l->id}}" id="picture{{$l->id}}" class="mt-4 picture{{$l->id}}" >
                                    <small class="border-bottom border-danger text-danger d-none picError{{$l->id}}"></small>

                                    <p class="help-block">Insert picture for this product for {{$l->liter}} liter </p>

                                </div>

                            </div><!-- /input-group -->


                            {{--                        </div>--}}
                        </div><!-- /.col-lg-6 -->
                    @endforeach


                    <div class="col-lg-12">
                        <button type="submit" id="update"  data-id="{{$product->id}}" class="btn btn-primary col-6 m-auto">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>

    </section><!-- /.content -->
@endsection
@section("script")
    <script src="{{asset("assets/js/updateProduct.js")}}"></script>
@endsection

{{--@section("script")--}}
{{--    <script src="{{asset("assets/js/login.js")}}"></script>--}}
{{--@endsection--}}

