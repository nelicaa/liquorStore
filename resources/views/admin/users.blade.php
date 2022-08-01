@extends("admin.layouts.layout")
@section("title", "Users")
@section("page", "Users")
@section("content")

{{--   // {{dd($users)}}--}}
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users</h3>
                    </div><!-- /.box-header -->
                    @if(session("mess"))
                        <p class="{{session("alert")}} alert">{{session("mess")}}</p>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="date-picker-example" class="col-6 d-flex ">
                        <label class="col-2 text-center m-auto">Filter for date:</label>
                        <input type="date" id="date" class="form-control" name="date">
                        <a href="/removeFilter" class="btn btn-default">Remove filter</a>
                    </div>
                    <div class="table-responsive p-1">
{{--                        <a href="/productsAdmin/create" class="text-info text-bold "><p>INSERT NEW PRODUCT</p></a>--}}

                        <table id="example2" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th></th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Street</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Zip code</th>
                                <th>Role</th>
                                <th></th>
                            </tr>

                            </thead>

                            <tbody id="tableHtml">
                            @foreach($users as $u)
                                {{--                                @foreach($p->liter as $l)--}}
{{--                                @for($i=0;$i<count($p->liter);$i++)--}}
                                    <tr>
                                        <td>{{$u->id}}</td>

                                        <td class="col-xs-3 col-sm-1"><img class="img img-thumbnail " src="{{asset("assets/images/users/".$u->picture)}}"></td>
                                        <td>{{$u->first_n}}</td>
                                        <td>{{$u->last_n}}</td>
                                        <td>{{$u->street}}</td>
                                        <td>
                                            {{$u->phone}}
                                        </td>
                                        <td>
                                            {{$u->email}}
                                        </td>
                                        {{--                                {{dd($p)}}--}}

                                        <td>
                                            {{$u->city->name}}
                                        </td>
                                        <td>
                                            {{$u->city->zipCode}}
                                        </td>

                                        <td>
                                            <form>
                                                @csrf
                                                <meta name="csrf-token" content="{{ csrf_token() }}">

                                                <select data-id="{{$u->id}}" class="form-control-lg update" name="role" aria-label="Default select example">
                                                @foreach($roles as $r)
                                                    @if($r->id == $u->role->id)
                                                        <option value="{{$r->id}}" selected>{{$r->name}}</option>
@else
                                                            <option value="{{$r->id}}">{{$r->name}}</option>

                                                        @endif

                                                @endforeach
                                            </select>
                                            </form>

{{--                                            {{$u->role->name}}--}}
                                        </td>

                                        <td>
                                            <form action="/user/{{$u->id}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <input type="submit" class="btn btn-danger delete" value="DELETE"/>

                                            </form>
                                        </td>
                                    </tr>
                                <tr class="border border-3">
                                    <th colspan="3">Registred at: </th>
                                    <th colspan="8" class="text-start">{{$u->created_at}}</th>
                                </tr>


{{--                                @endfor--}}
                            @endforeach
                            {{--                            @endforeach--}}

                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div></div></section>
@endsection

@section("script")
    <script src="{{asset("assets/js/updateRole.js")}}"></script>
@endsection

