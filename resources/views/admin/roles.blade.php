@extends("admin.layouts.layout")
@section("title", "Roles")
@section("page", "Roles")
@section("content")

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Roles</h3>
                    </div><!-- /.box-header -->
                    @if(session("mess"))
                        <p class="{{session("alert")}}  alert">{{session("mess")}}</p>
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
                    <div class="table-responsive-lg p-1">

                        <a href="/role/create" class="text-info text-bold "><p>INSERT NEW CATEGORY</p></a>

                        <table id="example2" class="table table-bordered p-5">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th></th>
                                <th></th>

                            </thead>
                            <tbody id="tableHtml">
                            @foreach($roles as $r)
                                <tr>
                                    <td>{{$r->id}}</td>

                                    <td>
                                        <form method="post" action="/role/{{$r->id}}">
                                            @csrf
                                            @method("put")

                                      <input type="text" name="value" class="form-control"  value="{{$r->name}}"/>

                                    </td>


                                        <td>
                                            <input type="submit" value="UPDATE" name="update" class="text-info btn"/>
                                        </td>
                                    </form>



                                    <td>

                                        <form action="/role/{{$r->id}}" method="post">
                                            @csrf
                                            @method("delete")
                                            <input type="submit" class="btn btn-danger delete" value="DELETE"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </td>   <td>

                            {{--                            @endforeach--}}

                            </tbody>

                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @for($i=1;$i<=$roles->lastPage();$i++)
                                    <li class="page-item"><a class="page-link" href="{{$roles->url($i)}}">{{$i}}</a></li>

                                @endfor
                                {{--                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}

                                {{--                                <li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
                            </ul>
                        </nav>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div></div></section>
@endsection
