@extends("admin.layouts.layout")
@section("title", "Dashboard")
@section("page", "Control panel")
@section("content")
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Messages from contact form</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    @if(session("mess"))
                        <p class="{{session("alert")}}  alert">{{session("mess")}}</p>
                    @endif
                    <table class="table table-bordered">
                        <tbody><tr>
                            <th></th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Delete</th>

                        </tr>
                        @foreach($mess as $m)
                            <tr>
                            <td></td>
                            <td>{{$m->email}}</td>
                            <td>{{$m->subject}}</td>
                            <td>{{$m->message}}</td>
                                <td>
<a href="deleteMess/{{$m->id}}" class="btn-outline-danger btn">DELETE</a>
{{--                                    <form action="/role/{{$m->id}}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        @method("delete")--}}
{{--                                        <input type="submit" class="btn btn-danger delete" value="DELETE"/>--}}
{{--                                    </form>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody></table>

                </div><!-- /.box-body -->

            </div><!-- /.box -->


{{--            </div><!-- /.box -->--}}
        </div><!-- /.col -->
        <div class="col-6 d-flex">
        <div class="small-box bg-aqua col-4">
            <div class="inner">
                <h3>{{$cartCount}}</h3>
                <p>Purchases made
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
{{--            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
        </div>
        <div class="small-box bg-success text-light col-4 ms-1">
            <div class="inner">
                <h3>{{$productsSum}}</h3>
                <p>Purchased products
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            {{--            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
        </div>
        <div class="small-box bg-orange text-light col-4 ms-1">
            <div class="inner">
                <h3>{{$users}}</h3>
                <p>Registred users
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            {{--            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
        </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Carts</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div id="date-picker-example" class="col-6 d-flex ">
                    <label class="col-2 text-center m-auto">Filter for date:</label>
                    <input type="date" id="date" class="form-control" name="date">
                    <a href="/" id="remove" class="btn btn-default">Remove filter</a>
                </div>

                <table class="table table-bordered">

                    <thead><tr>
                        <th></th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Purchased on </th>
                        <th>Products</th>
{{--                        <th>Quantity</th>--}}

                    </tr></thead>
                    <tbody id="html">
                    @foreach($cart as $c)
{{--                        {{dd($c)}}--}}
                        <tr>
                            <td>{{$c->id}}</td>
                            <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="{{asset("assets/images/users/".$c->user->picture)}}"></td>
                            <td>{{$c->user->email}}</td>
                            <td>{{$c->created_at}}</td>
    <td>        <button type="button" class="btn btn-primary products" data-id="{{$c->id}}" data-toggle="modal" data-target="#exampleModal">
            Click to see all bought products for this cart
        </button></td>
                        </tr>
                    @endforeach
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <!-- Button trigger modal -->
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal  fade" data-backdrop="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Products for this cart</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="showProducts">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                        <button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>
        {{--            </div><!-- /.box -->--}}
    </div><!-- /.col -->


@endsection
@section("script")
    <script src="{{asset("assets/js/cart.js")}}"></script>
@endsection

