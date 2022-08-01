@extends("admin.layouts.layout")
@section("title", "Products")
@section("page", "Products")
@section("content")

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Products</h3>
                    </div><!-- /.box-header -->

                    <div class="table-responsive-lg p-1">
                        <a href="/productsAdmin/create" class="text-info text-bold "><p>INSERT NEW PRODUCT</p></a>

                        <table id="example2" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Availabale liters</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Price with discount</th>

                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tableHtml">
                            @foreach($products as $p)
                                @for($i=0;$i<count($p->liter);$i++)
                                    <tr>
                                        <td>{{$p->price[$i]->product_liter_id}}</td>

                                        <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="{{asset("assets/images/products/".$p->liter[$i]->pivot->image)}}"></td>
                                        <td>{{$p->name}}</td>
                                        <td>{{$p->desc}}</td>
                                        <td>{{$p->category->name}}</td>
                                        <td>
                                            {{$p->liter[$i]->liter}} liter
                                        </td>
                                        <td>
                                            {{$p->price[$i]->price}} $
                                        </td>
                                        {{--                                {{dd($p)}}--}}

                                        <td>
                                            {{$p->price[$i]->discount}} %
                                        </td>
                                        <td>
                                            {{ $p->price[$i]->price-($p->price[$i]->price*$p->price[$i]->discount/100)}} $
                                        </td>

                                        <td>
                                            <a href="/productsAdmin/{{$p->id}}/edit" class="text-info">UPDATE</a>
                                        </td>   <td>
                                            <form action="" method="post">
                                                @csrf
                                                {{--                                                @method("delete")--}}
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-danger delete" data-id="{{$p->price[$i]->product_liter_id}}" value="DELETE"/>

                                            </form>
                                        </td>
                                    </tr>
                                @endfor
                            @endforeach
                            {{--                            @endforeach--}}

                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div></div></section>
@endsection

@section("script")
    <script src="{{asset("assets/js/deleteProduct.js")}}"></script>

@endsection
