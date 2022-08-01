@extends("admin.layouts.layout")
@section("title", "Cities")
@section("page", "Cities")
@section("content")

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Cities</h3>
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

                        <a href="/city/create" class="text-info text-bold "><p>INSERT NEW CITY</p></a>

                        <table id="example2" class="table table-bordered p-5">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Zip code</th>
                                <th></th>
                                <th></th>

                            </thead>
                            <tbody id="tableHtml">
                            @foreach($cities as $c)
                                    <tr>
                                        <td>{{$c->id}}</td>

                                        <form method="post" action="/city/{{$c->id}}">
                                            @csrf
                                            @method("put")
                                            <td>
                                                <input type="text" name="value" class="form-control"  value="{{$c->name}}"/>

                                            </td>
                                    <td>
                                {{$c->zipCode}}
                                            </td>


                                            <td>
                                                <input type="submit" value="UPDATE" name="update" class="text-info btn"/>
                                            </td>
                                        </form>

                                        <td>
                                            <form action="city/{{$c->id}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <input type="submit" class="btn btn-danger delete" value="DELETE"/>
                                            </form>
                                        </td>
                                    </tr>
                            @endforeach
                            {{--                            @endforeach--}}

                            </tbody>

                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @for($i=1;$i<=$cities->lastPage();$i++)
                                    <li class="page-item"><a class="page-link" href="{{$cities->url($i)}}">{{$i}}</a></li>

                                @endfor

                            </ul>
                        </nav>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div></div></section>


@endsection
