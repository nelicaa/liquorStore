@extends("admin.layouts.layout")
@section("title", "Liters")
@section("page", "Liters")
@section("content")

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liters</h3>
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

                        <a href="/liter/create" class="text-info text-bold "><p>INSERT NEW LITER</p></a>

                        <table id="example2" class="table table-bordered p-5">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th></th>
                                <th></th>

                            </thead>
                            <tbody id="tableHtml">
                            @foreach($liters as $l)
                                <tr>
                                    <td>{{$l->id}}</td>

                                    <td>
                                        <form method="post" action="/liter/{{$l->id}}">
                                            @csrf
                                            @method("put")

                                            <input type="text" name="liter" class="form-control"  value="{{$l->liter}}"/>

                                    </td>


                                    <td>
                                        <input type="submit" value="UPDATE" name="update" class="text-info btn"/>
                                    </td>
                                    </form>
                                    <td>
                                        <form action="liter/{{$l->id}}" method="post">
                                            @csrf
                                            @method("delete")
                                            <input type="submit" class="btn btn-danger delete" value="DELETE"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{--                            @endforeach--}}

                            </tbody>
                            {{--                            <tfoot>--}}
                            {{--                            <tr>--}}
                            {{--                                <th>Rendering engine</th>--}}
                            {{--                                <th>Browser</th>--}}
                            {{--                                <th>Platform(s)</th>--}}
                            {{--                                <th>Engine version</th>--}}
                            {{--                                <th>CSS grade</th>--}}
                            {{--                            </tr>--}}
                            {{--                            </tfoot>--}}
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @for($i=1;$i<=$liters->lastPage();$i++)
                                    <li class="page-item"><a class="page-link" href="{{$liters->url($i)}}">{{$i}}</a></li>

                                @endfor
                                {{--                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}

                                {{--                                <li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
                            </ul>
                        </nav>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div></div></section>
    @endsection
