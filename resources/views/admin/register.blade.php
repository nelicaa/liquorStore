@extends("admin.layouts.layout")
@section("title", "All registered users")
@section("page", "users")
@section("content")
    <section class="content">
{{--        {{dd($log)}}--}}
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Logged in and out</h3>
                    </div><!-- /.box-header -->
                    <div class="d-flex flex-row justify-content-around">
                        <div id="date-picker-example" class="col-6 d-flex ">
                            <label class="col-2 text-center m-auto">Filter for date:</label>
                            <input type="date" id="date" class="form-control" name="date">
                        </div>
                        <div class="col-2">
                            <select class="form-control" id="role" name="role" aria-label="Default select example">
                                <option value="0" selected>Choose role</option>
                                @foreach($roles as $r)
                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-control" id="log" name="log" aria-label="Default select example">
                                <option value="0" selected>Choose log</option>
                                    <option value="Logged in">	Logged in</option>
                                    <option value="Logged out">	Logged out</option>
                            </select>
                        </div>

                        <a href="#" class="btn btn-default" id="remove">Remove filter</a>

                    </div>


                    <div class="table-responsive p-1">
                        {{--                        <a href="/productsAdmin/create" class="text-info text-bold "><p>INSERT NEW PRODUCT</p></a>--}}

                        <table id="example2" class="table table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Ip address</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Logged in</th>
                                <th>Log out</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody id="tableHtml">
                            @foreach($log as $l)

                                <tr>
                                    <td></td>
                                    <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="{{asset("assets/images/users/".$l[0])}}"></td>
                                    <td>{{$l[2]}}</td>
                                    <td>{{$l[3]}}</td>
                                    <td>{{$l[1]}}</td>
                                    @if($l[4]=="Logged in")
                                        <td class="table-success">{{$l[4]}}</td>
                                        <td></td>

                                    @else
                                        <td></td>
                                        <td class="table-danger">{{$l[4]}}</td>
                                        @endif
                                    <td>{{$l[5]}}</td>



                                </tr>
                                {{--                                @endfor--}}
                            @endforeach

                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div></div></section>
@endsection

@section("script")
    <script src="{{asset("assets/js/register.js")}}"></script>
@endsection
